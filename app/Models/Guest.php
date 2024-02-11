<?php
// app/Models/Guest.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;
    protected $table = "guests";
    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'country',
        'state',
        'city',
        'street_address',
        'house_number',
    ];

    public function orders()
    {
        return $this->hasMany(GuestOrder::class, 'guest_id');
    }

    public function cart ()
    {
        return $this->hasMany(Cart::class, 'guest_id');
    }

   public function wishlist ()
    {
        return $this->hasMany(Wishlist::class, 'guest_id');
    }


}

