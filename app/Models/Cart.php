<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'price',
        'product_type',
        'paid_status',
    ];


    // Relationship with User (owner)
    public function owner()
    {
        return $this->belongsTo(User::class, 'product_id');
    }
}