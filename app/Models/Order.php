<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'cart_id', 'transaction_id', 'jml_cicilan'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id', 'id');
    }

    public function payment()
    {
        return $this->hasMany(Payment::class, 'transaction_id', 'transaction_id');
    }
}
