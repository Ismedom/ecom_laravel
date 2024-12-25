<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'view_count';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'viewer_id',
        'product_id',
    ];
    public function product()
    {
        return $this->belongsToMany(Product::class, 'product_id');
    }
    public function viewer()
    {
        return $this->belongsToMany(User::class, 'viewer_id');
    }
}