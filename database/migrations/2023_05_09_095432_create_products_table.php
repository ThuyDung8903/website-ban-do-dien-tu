<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->decimal('price', 10, 2, true);
            $table->decimal('sale_price', 10, 2, true)->nullable()->default(null);
            $table->integer('category_id')->unsigned();
//            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->integer('brand_id')->unsigned();
//            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->text('short_description')->nullable();
            $table->longText('detail_description')->nullable();
            $table->integer('view')->unsigned()->nullable();
            $table->integer('total_sold')->unsigned()->nullable()->default(0);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
//            $table->foreign('sale_price')
//                ->references('price')
//                ->on('products')
//                ->whereRaw('sale_price < price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table){
            $table->dropForeign('products_category_id_foreign');
            $table->dropForeign('products_brand_id_foreign');
            $table->dropForeign('products_sale_price_foreign');
        });
        Schema::dropIfExists('products');
    }
};
