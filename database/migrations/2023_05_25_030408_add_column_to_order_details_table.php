<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::table('order_details', function (Blueprint $table) {
            $table -> id()-> first();
            $table -> string('product_name')->nullable();
            $table -> string('product_price')->nullable();
            $table -> string('product_image')->nullable();
            $table -> string('product_color')->nullable();
            $table -> string('product_size')->nullable();

            $table -> dropColumn('created_at');
            $table -> dropColumn('updated_at');
        });
        Schema::table('order_details', function (Blueprint $table) {
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table( 'order_details', function (Blueprint $table) {
            $table -> dropColumn('id');
            $table -> dropColumn('product_name');
            $table -> dropColumn('product_price');
            $table -> dropColumn('product_image');
            $table -> dropColumn('product_color');
            $table -> dropColumn('product_size');
        });
    }
};
