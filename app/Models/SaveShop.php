<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaveShop extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'save_shop';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shop_name',
        'shop_id',
        'shop_profile_image',
    ];
    public function save_shop()
    {
        return $this->belongsTo(Shop::class, 'user_rating_id');
    }
}