<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Models\Product;

class Colors extends Model
{
    protected $table = "colors";

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
        return $this->belongsToMany(Product::class, 'product_colors', 'colors_id', 'products_id');
    }

    use SoftDeletes;
}
