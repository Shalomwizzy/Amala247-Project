<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = "products";
    protected $fillable = [
        'category_id',
        'product_name',
        'product_price',
        'product_image',
      
    ];


    public function category(){
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItems::class, 'product_id');
    }

    public function orderItem()
    {
        return $this->hasMany(GuestOrder::class, 'product_id');
    }

}
