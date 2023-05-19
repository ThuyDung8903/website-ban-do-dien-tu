<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';
    protected $fillable = [
        'content',
        'rating',
        'product_id',
        'customer_id',
        'status',
    ];

    public function products()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function customers()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }
}