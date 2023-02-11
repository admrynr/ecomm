<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Product;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model
{
    protected $table = "categories";

    protected $fillable = [
        'name',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    use SoftDeletes;

}
