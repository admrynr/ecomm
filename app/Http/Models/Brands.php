<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Models\Product;


class Brands extends Model
{
    protected $table = "brands";

    protected $fillable = [
        '*',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    use SoftDeletes;
}
