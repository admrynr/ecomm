<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Product;
use App\Http\Models\SubCategories;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model
{
    protected $table = "categories";

    protected $fillable = [
        '*',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get all of the comments for the Categories
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subcategories()
    {
        return $this->hasMany(SubCategories::class);
    }

    use SoftDeletes;

}
