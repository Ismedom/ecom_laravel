<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'shop_id',
        'user_owner_id',
        'category',
        'categories',
        'keywords',
        'language',
        'price',
        'image_base_url',
        'average_rating',
        'view_count',
    ];



    
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_owner_id');
    }
    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id');
    }
    public function product()
    {
        return $this->hasMany(Rating::class, 'product_id');
    }
    public function product_id()
    {
        return $this->hasMany(SaveProduct::class, 'product_id');
    }
    public function view_product()
    {
        return $this->hasMany(SaveProduct::class, 'product_id');
    }
}