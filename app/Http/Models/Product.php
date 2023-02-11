<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Models\Product;
use App\Http\Models\Categories;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'product_name', 'product_type', 'categories_id', 'is_verified', 'base_price', 'stock', 'image', 'final_price'
    ];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function categories()
    {
        return $this->belongsTo(Categories::class);
    }
}
