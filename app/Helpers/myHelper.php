<?php

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\KategoriLayanan;
use App\Models\KategoriPost;
use App\Models\Navigation;
use App\Models\Order;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;


if (!function_exists('getMenus')) {
    function getMenus()
    {
        return Navigation::with('subMenus')->whereNull('main_menu')->get();
    }
}

if (!function_exists('getKategoriLayanans')) {
    function getKategoriLayanans()
    {
        return KategoriLayanan::with('subLayanans')->whereNull('category_id')->get();
    }
}

if (!function_exists('getBlogs')) {
    function getBlogs()
    {
        return KategoriPost::with('subPosts')->whereNull('category_id')->get();
    }
}

if (!function_exists('getTransactions')) {
    function getTransactions()
    {
        return;
    }
}

function galeriPath(Request $request)
{
    $extension = $request->file('thumbnail')->getClientOriginalName();
    $filename = 'NMT' . Carbon::now()->format('ymd') . '_' . $extension;
    $file = request()->file('thumbnail') ? $request->file('thumbnail')->Storage::disk('images/galeri', $filename) :   null;
    return $file;
}
function userpath(Request $request)
{
    $extension = $request->file('thumbnail')->getClientOriginalName();
    $filename = 'NMT' . Carbon::now()->format('ymd') . '_' . $extension;
    $file = request()->file('thumbnail') ? $request->file('thumbnail')->Storage::disk('images/user', $filename) :   null;
    return $file;
}
function layananPath(Request $request)
{
    $extension = $request->file('thumbnail')->getClientOriginalName();
    $filename = 'NMT' . Carbon::now()->format('ymd') . '_' . 'layanan' . '.' . $extension;
    $file = $request->file('thumbnail') ? $request->file('thumbnail')->Storage::disk('images/layanan', $filename) : null;
    return $file;
}
function postPath(Request $request)
{
    $extension = $request->file('thumbnail')->getClientOriginalName();
    $filename = 'NMT' . Carbon::now()->format('ymd') . '_' . 'post' . '.' . $extension;
    $file = $request->file('thumbnail') ? $request->file('thumbnail')->Storage::disk('images/post', $filename) : null;
    return $file;
}

function updatePrice($item, $qty, $price, $discount)
{
    $new = $item;
    if ($item->qty + $qty != 0) {
        $new = CartItem::create([
            'qty' => $item->qty + $qty,
            'subtotal' => $item->subtotal + ($qty * $price),
        ]);
        return $new;
    } else {
        return $new->delete();
    }
}

// function updateTotal($item, $subtotal)
// {
//     $new = $item;
//     if ($item->subtotal + $subtotal != 0) {
//         $new = Cart::create([
//             'subtotal' => $item->subtotal + $subtotal,
//             'total' => $item->total + $subtotal,
//         ]);
//         return $new;
//     } else {
//         return $new->delete();
//     }
// }

// function updateTotal($item, $subtotal)
// {
//     if ($item->subtotal + $subtotal != 0) {
//         $item->subtotal += $subtotal;
//         $item->total +=  $subtotal;
//         $item->save();
//     }
//     $item->delete();
// }

// Store payment ids
function store_payment_ids(int $jumlah_cicilan, Order $order)
{
    $payment_ids = array();
    $dp = ($order->cart->total) * (30 / 100);
    $cicilan = ($order->cart->total - $dp) / $jumlah_cicilan;

    $auth = base64_encode(env('MIDTRANS_SERVER_KEY'));

    for ($i = 0; $i < $jumlah_cicilan; $i++) {
        $payment_id = Str::uuid();
        $new_cicilan = ceil($cicilan);
        $payment_ids["index"] = $i + 1;
        $payment_ids["payment_id"] = $payment_id->toString();
        $payment_ids["cicilan"] = $new_cicilan;

        $params = array(
            'transaction_details' => array(
                'order_id' => $payment_id->toString(),
                'gross_amount' => $new_cicilan,
            )
        );

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => "Basic $auth",
        ])->post('https://app.sandbox.midtrans.com/snap/v1/transactions', $params);

        $response = json_decode($response->body());

        $payment = new Payment();
        $payment->transaction_id = $order->transaction_id;
        $payment->payment_id = $payment_id->toString();
        $payment->type = 'pembayaran ke-' . strval($i + 1);
        $payment->due_date = Carbon::now()->addMonth($i + 1)->toDateString();
        $payment->link = $response->redirect_url;
        $payment->amount = $new_cicilan;
        $payment->status = 'pending';
        $payment->save();

        // $order->update([
        //     'payment_id' => $payment->id,
        // ]);
    };


    return $payment;
}

function cetakbulan($bulan)
{
    switch ($bulan) {
        case '1':
            return "Januari";
            break;
        case '2':
            return "Februari";
            break;
        case '3':
            return "Maret";
            break;
        case '4':
            return "April";
            break;
        case '5':
            return "Juni";
            break;
        case '6':
            return "Juli";
            break;
        case '7':
            return "Agustus";
            break;
        case '8':
            return "September";
            break;
        case '10':
            return "Oktober";
            break;
        case '11':
            return "November";
            break;
        case '12':
            return "Desember";
            break;

        default:
            return "";
            break;
    }
}
