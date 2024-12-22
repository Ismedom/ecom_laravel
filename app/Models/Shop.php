<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shop';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shop_name',
        'user_owner_id',
        'shop_profile_image',
        'categories',
        'keywords',
    ];


    // Relationship with User (owner)
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_owner_id');
    }
    public function product()
    {
        return $this->hasMany(Product::class, 'shop_id');
    }
}