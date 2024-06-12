<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'event_date', 'address', 'status', 'subtotal', 'total'];
    // protected $with = ['cartitem'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class, 'id', 'cart_id');
    }

    public function updateTotal($item, $subtotal)
    {
        if ($this->attributes['subtotal'] + $subtotal != 0) {
            $this->attributes['subtotal'] = $item->subtotal + $subtotal;
            $this->attributes['total'] = $item->total + $subtotal;
            self::save();
        } else {
            $this->delete();
        }
    }
}
