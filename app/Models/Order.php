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
        'shipping_method_id',
        'payment_method_id',
        'total_price',
        'total_bill',
        'order_status_id',
        'comment',
    ];

    public function customers()
    {
        $this->hasOne(Customer::class, 'id', 'customer_id');
    }
    public function order_statuses()
    {
        $this->hasOne(OrderStatus::class, 'id', 'order_status_id');
    }
    public function payment_methods()
    {
        $this->hasOne(PaymentMethod::class, 'id', 'payment_method_id');
    }
    public function shipping_methods()
    {
        $this->hasOne(ShippingMethod::class, 'id', 'shipping_method_id');
    }
    public function order_details()
    {
        $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
}
