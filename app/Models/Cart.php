<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable = [
        'order_id',
        'user_id',
        'guest_id',
        'product_id',
        'quantity',
        'amount',
        'takeaway_pack',
        'delivery_fee',
        'subtotal',
        'total',
        'cart_status',
        'coupon_code',
        'coupon_discount_amount',
        'coupon_expiry_date',
    ];

    // Define the relationship with the Product model
    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function guest()
    {
        return $this->belongsTo(guest::class, 'guest_id');
    }

}
