<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    use HasFactory;

    protected $table = 'shipping_methods';
    protected $fillable = [
        'name',
        'shipping_fee',
        'status',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'order_id', 'id');
    }
}