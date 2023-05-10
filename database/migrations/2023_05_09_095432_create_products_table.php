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
            $table->decimal('price')->unsigned();
            $table->decimal('sale_price')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->integer('brand_id')->unsigned();
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->text('short_description')->nullable();
            $table->longText('detail_description')->nullable();
            $table->integer('view')->unsigned();
            $table->integer('total_sold')->unsigned();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
        DB::statement('ALTER TABLE products ADD CONSTRAINT chk_sale_price_less_price CHECK ( products.sale_price <= products.price );');
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
            DB::statement('ALTER TABLE products DROP CONSTRAINT chk_sale_price_less_price;');
        });
        Schema::dropIfExists('products');
    }
};
