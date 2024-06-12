<?php

namespace App\Http\Controllers;

use App\DataTables\CartDataTable;
use App\DataTables\OrderDataTable;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function display($transaction_id)
    {
        $order = Order::where('transaction_id', $transaction_id)->first();
        $payment = Payment::where('transaction_id', $order->transaction_id)->first();

        if ($order) {
            return view('shop.checkout', [
                'title' => 'Checkout',
                'order' => $order,
                'payment' => $payment,
            ]);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $cart = Cart::where('user_id', $user->id)
            ->where('status', 'cart')
            ->first();

        // if ($cart) {
        //     return $datatables->render('shop.cart', [
        //         'cart' => $cart,
        //     ]);
        // } else {
        //     return view('shop.emptyCart');
        // }

        if ($cart) {
            return view('shop.cart', [
                'title' => 'Keranjang Belanja',
                'cart' => $cart,
            ]);
        } else {
            return view('shop.emptyCart');
        }
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
        // dd($request->cicilan);
        $this->validate($request, ['event_date' => 'required']);
        $cicilan = $request->cicilan;
        $user = $request->user();
        $cart = Cart::where('user_id', $user->id)
            ->where('status', 'cart')
            ->first();

        $count_code = Cart::all()->count();
        $code = 'INV ' . Carbon::now()->format('ymd') . str_pad(($count_code), '3', '0', STR_PAD_LEFT);
        $payment_id = Str::uuid();

        if ($cart) {
            $order = Order::create([
                'user_id' => $user->id,
                'transaction_id' => $code,
                'cart_id' => $cart->id,
                'jml_cicilan' => $cicilan,
            ]);

            $cart->update([
                'event_date' => $request->event_date,
            ]);

            if ($cart && ($cicilan != 0)) {
                // import ke midtrans harga dp
                $dp = ($cart->total) * (30 / 100);

                $params = array(
                    'transaction_details' => array(
                        'order_id' => $payment_id,
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
                $payment->transaction_id = $code;
                $payment->payment_id = $payment_id;
                $payment->type = 'DP';
                $payment->due_date = Carbon::now()->toDateString();
                $payment->link = $response->redirect_url;
                $payment->amount = $dp;
                $payment->status = 'pending';
                $payment->save();

                switch ($cicilan) {
                    case 1:
                        store_payment_ids(1, $order);
                        break;
                    case 3:
                        store_payment_ids(3, $order);
                        break;
                    case 6:
                        store_payment_ids(6, $order);
                        break;
                    case 12:
                        store_payment_ids(12, $order);
                        break;
                }
                $cart->update([
                    'status' => 'ordered'
                ]);

                return redirect()->route('cart.display', $code);
            } elseif ($cart && ($cicilan == 0)) {
                $params = array(
                    'transaction_details' => array(
                        'order_id' =>  $payment_id,
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
                $payment->transaction_id = $order->transaction_id;
                $payment->payment_id =  $payment_id;
                $payment->type = 'FULL PAYMENT';
                $payment->due_date = Carbon::now()->toDateString();
                $payment->link = $response->redirect_url;
                $payment->amount = $cart->total;
                $payment->status = 'pending';
                $payment->save();

                $cart->update([
                    'status' => 'ordered',
                ]);

                return redirect()->route('cart.display', $code);
            }
        } else {
            return abort('404');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        $cart->cartItems()->delete();
        $cart->delete();

        return back()->with('success', 'Cart berhasil dikosongkan');
    }
}
