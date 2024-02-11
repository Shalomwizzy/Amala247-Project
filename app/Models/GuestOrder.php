<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestOrder extends Model
{
    use HasFactory;
    protected $table = "guest_orders";
    protected $fillable = [
        'order_id',
        'guest_id',
        'product_id',
        'quantity',
        'amount',
        'order_status',
        'takeaway_pack',
        'delivery_fee',
        'subtotal',
        'total',
        'paystack_ref',
        'order_type',
        'paystack_date',
        'paid_amount',
       
    ];




   



    public function items()
    {
        return $this->hasMany(OrderItems::class, 'order_id', 'order_id');
    }


    public function guest()
{
    return $this->belongsTo(Guest::class, 'guest_id');
}

// public function products()
// {
//     return $this->hasMany(Products::class, 'product_id');
// }

public function product()
{
    return $this->belongsTo(Products::class, 'product_id');
}

public function orderItems()
{
    return $this->hasMany(OrderItems::class, 'order_id', 'order_id');
}

}

