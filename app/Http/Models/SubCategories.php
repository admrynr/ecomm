<?php

namespace App\Http\Models;

use App\Http\Models\Categories;
use App\Http\Models\Product;
use Illuminate\Database\Eloquent\Model;

class SubCategories extends Model
{
    protected $table = "sub_categories";

    protected $fillable = [
        '*',
    ];

    /**
     * Get the user that owns the SubCategories
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Categories()
    {
        return $this->belongsTo(Categories::class);
    }

    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
