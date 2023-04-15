<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Product;
use App\Http\Models\Colors;


class ProductColors extends Model
{
    protected $table = "product_colors";

    protected $fillable = [
        '*',
    ];
}
