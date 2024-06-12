<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $fillable = ['cart_id', 'layanan_id', 'qty', 'price', 'subtotal'];
    protected $with = ['layanans'];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
    public function layanans()
    {
        return $this->belongsTo(Layanan::class, 'layanan_id', 'id');
    }

    function updateItems($item, $qty, $price)
    {
        if ($item->qty + $qty != 0) {
            $this->attributes['qty'] = $item->qty + $qty;
            $this->attributes['subtotal'] = $item->subtotal +  ($qty * $price);
            self::save();
        } else {
            // i
            $this->delete();
        }
    }
}
