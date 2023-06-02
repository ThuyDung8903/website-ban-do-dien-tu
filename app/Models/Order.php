<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = [
        'customer_id',
        'order_status_id',
        'payment_method_id',
        'shipping_method_id',
        'total_price',
        'total_bill',
        'customer_name',
        'customer_phone',
        'customer_email',
        'customer_address',
        'shipping_name',
        'shipping_phone',
        'shipping_email',
        'shipping_address',
        'shipping_zip_code',
        'tax_price',
        'customer_shipping_price',
        'customer_payment_price',
        'tracking_number',
        'payment_mode',
        'payment_id',
    ];

    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    public function order_status()
    {
        return $this->hasOne(OrderStatus::class, 'id', 'order_status_id');
    }

    public function payment_method()
    {
        return $this->hasOne(PaymentMethod::class, 'id', 'payment_method_id');
    }

    public function shipping_method()
    {
        return $this->hasOne(ShippingMethod::class, 'id', 'shipping_method_id');
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
}
