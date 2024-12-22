<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rating';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable =
    [   'product_id',
        'user_rating_id',
        'rating'
    ];

    
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}