<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Product;

class Sizes extends Model
{
    protected $table = "sizes";

    protected $fillable = [
        '*',
    ];

    /**
     * The roles that belong to the Colors
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_sizes', 'sizes_id', 'products_id');
    }
}
