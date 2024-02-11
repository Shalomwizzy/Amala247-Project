<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $table = "coupons";

    protected $fillable = [
        'code',
        'type',
        'value',
        'cart_value',
        'expiry_date',
    ];



    public function calculateDiscount($subtotal)
    {
        if ($this->type === 'percent') {
            // Percentage discount
            $discountPercentage = $this->value;
            $discount = ($discountPercentage / 100) * $subtotal;
        } elseif ($this->type === 'fixed') {
            // Fixed-value discount
            $discount = $this->value;
        } else {
            // Unsupported coupon type
            $discount = 0;
        }

        return $discount;
    }


}



