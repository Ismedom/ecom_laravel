<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaveProduct extends Model
{

    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'save_product';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'user_saved_id',
        'description',
        'category',
        'price',
        'product_id',
        'product_type',
        'image_base_url'
    ];
    public function product_id()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function user_id()
    {
        return $this->belongsTo(User::class, 'user_saved_id');
    }
}