<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function views()
    {
        return $this->hasMany(View::class, 'viewer_id');
    }
    public function shop_owner()
    {
        return $this->hasMany(Shop::class, 'user_owner_id');
    }
    public function product_owner()
    {
        return $this->hasMany(Product::class, 'user_owner_id');
    }
    public function rating()
    {
        return $this->hasMany(Rating::class, 'user_rating_id');
    }
    public function user_id()
    {
        return $this->hasMany(SaveShop::class, 'user_saved_id');
    }
    public function user_product_id()
    {
        return $this->hasMany(SaveProduct::class, 'user_saved_id');
    }
    public function view_product()
    {
        return $this->belongsToMany(Product::class, 'product_id');
    }
    public function carting()
    {
        return $this->hasMany(Cart::class, 'user_carting_id');
    }

}