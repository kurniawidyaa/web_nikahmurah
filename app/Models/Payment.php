<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = ['transaction_id', 'payment_id', 'type', 'due_date', 'amount', 'link', 'status'];

    public function  order()
    {
        return $this->belongsTo(Order::class, 'transaction_id', 'transaction_id');
    }
}
