<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Models\Colors;
use App\Http\Models\Categories;
use App\Http\Models\Brands;

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

    public function brands()
    {
        return $this->belongsTo(Brands::class);
    }

    /**
     * The roles that belong to the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function colors()
    {
        return $this->belongsToMany(Colors::class, 'product_colors', 'products_id', 'colors_id');
    }

    public function sizes()
    {
        return $this->belongsToMany(Colors::class, 'product_sizes', 'products_id', 'sizes_id');
    }
}
