<?php

namespace App\Http\Controllers;

use App\DataTables\DashboardOrderDataTable;
use App\DataTables\OrderDataTable;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function display(OrderDataTable $datatables)
    {
        return $datatables->render('shop.order');
    }
    public function dashboard(DashboardOrderDataTable $dashboarddatatables)
    {
        return $dashboarddatatables->render('transaction.index');
    }

    public function index(OrderDataTable $datatables)
    {
        // $p = Payment::first();
        // dd($p->orders->cart->event_date);
        return $datatables->render('shop.order');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $cart = Cart::where('status', 'ordered')
            ->where('user_id', $user->id)
            ->first();

        $pay = $request->param;

        if ($cart && $pay == 'dp') {
            // import ke midtrans harga dp
            $dp = ($cart->total) * (30 / 100);

            $params = array(
                'transaction_details' => array(
                    'order_id' => $cart->id,
                    'gross_amount' => $dp,
                )
            );

            $auth = base64_encode(env('MIDTRANS_SERVER_KEY'));

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => "Basic $auth",
            ])->post('https://app.sandbox.midtrans.com/snap/v1/transactions', $params);

            $response = json_decode($response->body());

            $payment = new Payment;
            $payment->transaction_id = $cart->order->transaction_id;
            $payment->type = 'DP';
            $payment->due_date = Carbon::now()->toDateString();
            $payment->link = $response->redirect_url;
            $payment->amount = $dp;
            $payment->status = 'pending';
            $payment->save();

            $cart->order->update([
                'payment_id' => $payment->id,
            ]);

            return view('shop.payment');
        } elseif ($cart && $pay == 'lunas') {
            $params = array(
                'transaction_details' => array(
                    'order_id' => $cart->id,
                    'gross_amount' => $cart->total,
                )
            );

            $auth = base64_encode(env('MIDTRANS_SERVER_KEY'));

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => "Basic $auth",
            ])->post('https://app.sandbox.midtrans.com/snap/v1/transactions', $params);

            $response = json_decode($response->body());

            $payment = new Payment;
            $payment->transaction_id = $cart->order->transaction_id;
            $payment->type = '';
            $payment->link = $response->redirect_url;
            $payment->amount = $cart->total;
            $payment->status = 'pending';
            $payment->save();

            $cart->order->update([
                'payment_id' => $payment->id,
            ]);

            return view('shop.payment');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($payment_id)
    {
        // dd('test');
        $payment = Payment::where('payment_id', $payment_id)->where('status', 'lunas')->firstOrFail();
        if ($payment) {
            return view('shop.show', [
                'payment' => $payment,
                'title' => 'Invoice',
            ]);
        }
    }

    public function generate_pdf($payment_id)
    {
        $payment = Payment::where('payment_id', $payment_id)->where('status', 'lunas')->firstOrFail();
        $pdf = Pdf::loadView('pdf.invoice', ['payment' => $payment])->setPaper('a4');
        return $pdf->stream('invoice.pdf');
        // return $pdf->download('invoice.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart, Order $order)
    {
        return view('transaction.orderAction', compact(['cart', 'order']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil dihapus'
        ]);
    }

    public function PdfOrder(Request $request)
    {
        $bulan = cetakbulan($request->bulan);
        $tahun = $request->tahun;

        $bln_transaksi = date('Y-m', strtotime($tahun . '-' . $bulan));
        // dd($bln_transaksi);

        $order = Order::with(['cart' => function ($q) use ($bln_transaksi) {
            $q->where('created_at', 'like', '%' . $bln_transaksi . '%');
            $q->where('status', 'ordered');
        }])->get();

        // $order = Order::whereHas('cart', function ($q) use ($request) {
        //     $q->where('created_at', '>=', $request->start_date);
        //     $q->where('created_at', '<=', $request->end_date);
        // })->get();

        // $order = Order::where('created_at', '>=', $request->start_date)->where('created_at', '<=', $request->end_date)->get();

        // dd($order);
        // return view('pdf.dataOrder', compact(['order', 'bulan', 'tahun']));
        $pdf = Pdf::loadView('pdf.dataOrder', [
            'order' => $order,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ])->setPaper('a4');
        return $pdf->stream('Laporan.pdf');
    }

    public function cek(Request $request, DashboardOrderDataTable $datatables)
    {
        $bulan = cetakbulan($request->bulan);
        $tahun = $request->tahun;
        $bulan_transaksi = date('Y-m', strtotime($tahun . '-' . $bulan));

        // $order = Order::whereHas('cart', function ($q) use ($bulan_transaksi) {
        //     $q->where('created_at', 'like', $bulan_transaksi . '%');
        // })->get();

        // dd($order);

        // return view('pdf.dataOrder', compact(['order', 'bulan', 'tahun']));
        return $datatables->render('pdf.test');
    }
}
