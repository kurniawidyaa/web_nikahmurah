<?php

namespace App\Http\Controllers;

use App\DataTables\PaymentDataTable;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function show(PaymentDataTable $datatables, $id)
    {
        return $datatables->render('shop.payment', [
            'title' => 'Data Pembayaran',
        ]);
    }

    public function display(Request $request)
    {
        $user = $request->user();
        $order = Order::whereHas('cart', function ($q) use ($user) {
            $q->where('status', 'ordered');
            $q->where('user_id', $user->id);
        })->first();
        $payment = Payment::whereHas('order', function ($q) use ($order) {
            $q->where('order_id', $order->id);
            $q->where('status', 'pending');
        })->first();

        $paid = Payment::whereHas('order', function ($q) use ($order) {
            $q->where('order_id', $order->id);
            $q->where('status', 'capture');
        })->first();
        // dd($payment->link);
        if ($order) {
            return view('shop.pay', [
                'title' => 'Payment',
                'order' => $order,
                'payment' => $payment,
            ]);
        } elseif ($paid) {
            return route('order.index');
        }
    }

    public function installment(Request $request)
    {
        $user = $request->user();
        $order = Order::whereHas('cart', function ($q) use ($user) {
            $q->where('status', 'cart');
            $q->where('user_id', $user->id);
        })->first();
        $jml_cicilan = $order->jml_cicilan;


        switch ($jml_cicilan) {
            case 3:
                // $payment_ids = store_payment_ids(3, $order);
                // return $payment_ids;
                store_payment_ids(3, $order);
                break;
            case 6:
                // $payment_ids = store_payment_ids(6, $order);
                // return $payment_ids;
                store_payment_ids(6, $order);
                break;
            case 12:
                // $payment_ids = store_payment_ids(12, $order);
                // return $payment_ids;
                store_payment_ids(12, $order);
                break;

            default:
                // $payment_ids = store_payment_ids(1, $order);
                store_payment_ids(1, $order);
                break;
        }
        $order->cart->update([
            'status' => 'ordered'
        ]);
        return route('payment.display');
    }
    public function store(Request $request)
    {
        $user = $request->user();
        $cart = Cart::where('status', 'cart')
            ->where('user_id', $user->id)
            ->first();
        // $order = Order::where('cart_id', $cart->id)->first();
        $pay = $request->param;
        $payment_id = Str::uuid();

        // jumlah cicilan
        $order = Order::whereHas('cart', function ($q) use ($user) {
            $q->where('status', 'cart');
            $q->where('user_id', $user->id);
        })->first();
        $jml_cicilan = $order->jml_cicilan;

        if ($cart && $pay == 'dp') {
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
            $payment->order_id = $order->id;
            $payment->payment_id = $payment_id;
            $payment->type = 'DP';
            $payment->due_date = Carbon::now()->toDateString();
            $payment->link = $response->redirect_url;
            $payment->amount = $dp;
            $payment->status = 'pending';
            $payment->save();

            switch ($jml_cicilan) {
                case 3:
                    store_payment_ids(3, $order);
                    break;
                case 6:
                    store_payment_ids(6, $order);
                    break;
                case 12:
                    store_payment_ids(12, $order);
                    break;

                default:
                    store_payment_ids(1, $order);
                    break;
            }
            $order->cart->update([
                'status' => 'ordered'
            ]);
            // 

            return route('order.display');
        } elseif ($cart && $pay == 'lunas') {
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
            $payment->order_id = $order->id;
            $payment->payment_id =  $payment_id;
            $payment->type = 'FULL PAYMENT';
            $payment->due_date = Carbon::now()->toDateString();
            $payment->link = $response->redirect_url;
            $payment->amount = $cart->total;
            $payment->status = 'pending';
            $payment->save();

            $order->cart->update([
                'status' => 'ordered',
            ]);

            return route('order.display');
        }
    }

    public function callback(Request $request)
    {
        //  return json_decode($request->getContent());

        $auth = base64_encode(env('MIDTRANS_SERVER_KEY'));

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => "Basic $auth",
        ])->get("https://api.sandbox.midtrans.com/v2/$request->order_id/status");

        $response = json_decode($response->body());

        // check to db
        $payment = Payment::where('payment_id', $response->order_id)->firstOrFail();

        if ($payment->status === 'settlement' || $payment->status === 'capture') {
            return response()->json("Payment has been already processed");
        }

        if ($response->transaction_status === 'capture') {
            // Misal memasukkan atau mengirimkan link dari pembelian ke customer
            $payment->status = 'lunas';
        } elseif ($response->transaction_status === 'settlement') {
            // Misal memasukkan atau mengirimkan link dari pemebelian customer
            $payment->status = 'lunas';
        } elseif ($response->transaction_status === 'pending') {
            $payment->status = 'pending';
        } elseif ($response->transaction_status === 'deny') {
            $payment->status = 'deny';
        } elseif ($response->transaction_status === 'expire') {
            $payment->status = 'expire';
        } elseif ($response->transaction_status === 'cancel') {
            $payment->status = 'cancel';
        }

        $payment->save();

        return response()->json('success');
    }
}
