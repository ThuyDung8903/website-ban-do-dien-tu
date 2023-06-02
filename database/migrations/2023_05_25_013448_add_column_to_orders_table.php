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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('customer_name')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_address')->nullable();
            $table->string('shipping_name')->nullable();
            $table->string('shipping_phone')->nullable();
            $table->string('shipping_email')->nullable();
            $table->string('shipping_address')->nullable();
            $table->string('shipping_zip_code')->nullable();
            $table->string('tax_price')->nullable();
            $table->string('customer_shipping_price')->nullable();
            $table->string('customer_payment_price')->nullable();
            $table->string('tracking_number')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('payment_id')->nullable();
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('customer_name');
            $table->dropColumn('customer_phone');
            $table->dropColumn('customer_email');
            $table->dropColumn('customer_address');
            $table->dropColumn('shipping_name');
            $table->dropColumn('shipping_phone');
            $table->dropColumn('shipping_email');
            $table->dropColumn('shipping_address');
            $table->dropColumn('shipping_zip_code');
            $table->dropColumn('tax_price');
            $table->dropColumn('customer_shipping_price');
            $table->dropColumn('customer_payment_price');
            $table->dropColumn('tracking_number');
            $table->dropColumn('payment_mode');
            $table->dropColumn('payment_id');
        });
    }
};
