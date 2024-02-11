<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Permission;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table ="users";
    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'username',
        'email',
        'password',
        'role',
        'profile_picture',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

 
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getProfilePictureAttribute($value)
{
    if ($value) {
        return asset($value);
    } else {
        return asset('user.jpeg');
    }
}

    public function cart ()
    {
        return $this->hasMany(Cart::class, 'user_id');
    }

   public function wishlist ()
    {
        return $this->hasMany(Wishlist::class, 'user_id');
    }

    public function userAddress()
{
    return $this->hasOne(UserAddress::class, 'user_id');
}

public function orders()
{
    return $this->hasMany(UserOrder::class, 'user_id');
}


public function reviews()
{
    return $this->hasMany(Review::class);
}


}



