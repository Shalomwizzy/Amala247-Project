<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    use HasFactory;
    protected $table = 'user_orders';
    protected $fillable = [
        'order_id',
        'user_id',
        'order_type',
        'product_id',
        'quantity',
        'amount',
        'user_address_id',
        'order_status',
        'takeaway_pack',
        'delivery_fee',
        'subtotal',
        'total',
        'paystack_ref',
        'paystack_date',
        'paid_amount',
        'coupon_code',
        'coupon_amount'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function userAddress()
    {
        return $this->belongsTo(UserAddress::class, 'user_address_id');
    }

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItems::class, 'order_id', 'order_id');
    }

    
    
    public function orderItems()
    {
        return $this->hasMany(UserOrder::class, 'order_id', 'order_id');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'coupon_code', 'code');
    }
    
}
