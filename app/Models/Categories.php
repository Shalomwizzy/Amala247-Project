<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $table = "categories";
    protected $fillable = [
        'name',
        'image'
    ];

    protected static function boot()
    {
        parent::boot();
    
        static::creating(function ($category) {
            if (!$category->image) {
                $category->image = 'images/default.png'; // Path relative to the public directory
            }
        });
    }


    public function products()
    {
        return $this->hasMany(Products::class, 'category_id');
    }
}
