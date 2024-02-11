<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'guest_id',
        'shipping_address_id',
        'order_id',
        'total',
        'order_status',
        'is_read', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItems::class, 'order_id', 'order_id');
    }


    public function userAddress()
    {
        return $this->belongsTo(UserAddress::class, 'user_address_id');
    }

    public function products()
{
    return $this->hasMany(Products::class);
}

    public function userOrders()
{
    return $this->hasMany(UserOrder::class, 'order_id', 'order_id');
}

public function guestOrder()
{
    return $this->hasMany(GuestOrder::class, 'order_id', 'order_id');
}

}