<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartItemRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Layanan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Calculation\Web\Service;

class CartItemController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, ['layanan_id' => 'required']);
        $user = $request->user();
        $hasLayanan = Layanan::findOrFail($request->layanan_id);

        $cart = Cart::where('user_id', $user->id)
            ->where('status', 'cart')->first();

        if (!$cart) {
            $newCart = Cart::Create([
                'user_id' => $user->id,
                // 'address' => $request->alamat,
                'address' => 'alamat default',
                'status' => 'cart',
            ]);
        } else {
            $newCart = $cart;
        }

        $check = CartItem::where('cart_id', $newCart->id)->where('layanan_id', $hasLayanan->id)->first();

        $qty = 1;
        $price = $hasLayanan->price;
        $subtotal = $qty * $price;

        if (!$check) {
            $newCartItem = $request->all();
            $newCartItem = CartItem::create([
                'cart_id' => $newCart->id,
                'layanan_id' => $hasLayanan->id,
                'qty' => $qty,
                'price' => $price,
                'subtotal'  => ($price * $qty),
            ]);
            $newCartItem->Cart->updateTotal($newCartItem->Cart, $subtotal);
        } else {
            $check->updateItems($check, $qty, $price);
            $check->Cart->updateTotal($check->cart, $subtotal);
        }

        return redirect()->route('cart.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = CartItem::findOrFail($id);
        $kurang = $request->kurang;
        $tambah = $request->tambah;
        $qty = $item->qty;

        if ($tambah) {
            // update cart item
            $qty = 1;
            $item->updateItems($item, $qty, $item->price);
            // update cart
            $item->cart->updateTotal($item->cart, $item->price);

            return back()->with('success', 'Item berhasil ditambah');
            response()->json([
                'status' => 'success',
                'message' => 'Data berhasil diupdate!'
            ]);
        } elseif ($kurang > 0) {
            // $param == 'kurang' && $qty > 0
            // update items
            $qty = 1;
            $item->updateItems($item, '-' . $qty, $item->price);

            // update total
            $item->cart->updateTotal($item->cart, '-' . $item->price);

            return back()->with('success', 'Item berhasil dikurang');
            response()->json([
                'status' => 'success',
                'message' => 'Data berhasil diupdate!'
            ]);
        } elseif ($kurang == 0) {
            $item->delete();
            $item->cart->delete();

            return back();
            response()->json([
                'status' => 'success',
                'message' => 'item berhasil dihapus!'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CartItem $cartItem)
    {
        // dd($cartItem);
        $cartItem->delete();
        // update total
        $cartItem->Cart->updateTotal($cartItem->Cart, '-' . $cartItem->subtotal);
        return back()->with('success', "data berhasil di hapus");
        // response()->json([
        //     'status' => 'success',
        //     'message' => 'Data berhasil dihapus'
        // ]);
    }
}
