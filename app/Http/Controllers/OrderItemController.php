<?php

namespace App\Http\Controllers;

use App\Http\Requests\LayananRequest;
use App\Http\Requests\OrderItemRequest;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\RoleRequest;
use App\Models\Layanan;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $this->authorize('read order_item');
        $this->validate($request, [
            'layanan_id' => 'required',
        ]);
        $user = $request->user();
        $items = Order::where('user_id', $user->id)
            ->where('status', 'cart')
            ->first();
        if ($items) {
            return view('order.cart', [
                'title' => 'Keranjang Belanja',
                'items' => $items,
            ]);
        }
        return view('order.emptyCart');
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
        $this->validate($request, [
            'layanan_id' => 'required',
        ]);
        $user = $request->user();
        $layanan = Layanan::findOrFail($request->layanan_id);
        // check shopping cart get user id or not
        $order = Order::where('user_id', Auth::user()->id)->where('status', 'cart')->first();

        if ($order != null) {
            $item = $order;
        } else {
            $input['user_id'] = $user->id;
            $input['status'] = 'cart';
            $input['date'] = Carbon::now();
            $input = $orderRequest->all();
            $item = Order::create($input);
        }

        $check = OrderItem::where('order_id', $item->id)->where('layanan_id', $item->layanan->id);
        $qty = 1;
        $harga = $layanan->price;
        $subtotal = $layanan->subtotal = ($qty * $harga);

        if ($check != null) {
            $check->Order->updateTotal($check->Order, $subtotal);
        } else {
            $orderInput = $orderItemRequest->all();
            $orderInput['subtotal'] = ($harga * $qty);
            $orderItem = OrderItem::create($orderInput);
            $orderItem->Order->updateTotal($check->Order, $subtotal);
        }
        return redirect()->route('orderItem.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderItem  $orderItem
     * @return \Illuminate\Http\Response
     */
    public function show(OrderItem $orderItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderItem  $orderItem
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderItem $orderItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderItem  $orderItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderItem $orderItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderItem  $orderItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderItem $orderItem)
    {
        //
    }
}
