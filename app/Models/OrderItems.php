<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;

    protected $table = 'order_items';

    protected $fillable = [
        'order_id',
        'order_type',
        'product_id',
        'quantity',
        'guest_id',
        'user_id',
        'amount',
        'total',
        'order_status',
        'paystack_ref',
        'paystack_date',
        'paid_amount',
        'is_read',
    ];

 

// public function userOrder()
// {
//     return $this->belongsTo(UserOrder::class, 'order_id', 'order_id');
// }

// public function guestOrder()
// {
//     return $this->hasMany(GuestOrder::class, 'order_id', 'order_id');
// }

public function userOrder()
{
    return $this->belongsTo(UserOrder::class, 'order_id', 'order_id');
}


public function guestOrder()
{
    return $this->belongsTo(GuestOrder::class, 'order_id', 'order_id');
}


public function product()
{
    return $this->belongsTo(Products::class, 'product_id');
}


public function userAddress()
{
    return $this->belongsTo(userAddress::class);
}

public function order()
{
    return $this->belongsTo(UserOrder::class, 'order_id', 'order_id');
}




}