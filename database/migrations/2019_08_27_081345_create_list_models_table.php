<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('categories_id');
            $table->integer('sub_categories_id');
            $table->integer('brands_id');
            $table->integer('colors_id')->nullable();
            $table->string('size')->nullable();
            $table->string('product_name');
            $table->integer('mitra_price');
            $table->integer('reseller_price');
            $table->integer('stock');
            $table->integer('is_verified');
            $table->string('image')->default('default.png');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
