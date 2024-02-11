<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $table = 'user_addresses'; // Update the table name to match the 'users' table

    protected $fillable = [
        'user_id',
        'street_address',
        'house_number',
        'city',
        'state',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function userOrders()
    {
        return $this->hasMany(Order::class, 'user_address_id');
    }
}




