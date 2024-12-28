<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cart';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'user_carting_id',
        'name',
        'price',
        'product_type',
        'paid_status',
    ];


    // Relationship with User (owner)
    public function owner()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function carting()
    {
        return $this->belongsToMany(User::class, 'user_carting_id');
    }
}