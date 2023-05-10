<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'name',
        'price',
        'sale_price',
        'category_id',
        'brand_id',
        'short_description',
        'detail_description',
        'view',
        'total_sold',
        'status',
    ];

    public function product_attribute_values()
    {
        $this->hasMany(ProductAttributeValue::class, 'product_id', 'id');
    }

    public function images()
    {
        $this->hasMany(Image::class, 'product_id', 'id');
    }

    public function reviews()
    {
        $this->hasMany(Review::class, 'product_id', 'id');
    }

    public function order_details()
    {
        $this->hasMany(OrderDetail::class, 'product_id', 'id');
    }

    public function categories()
    {
        $this->hasOne(Category::class, 'id', 'category_id');
    }
    public function brands()
    {
        $this->hasOne(Brand::class, 'id', 'brand_id');
    }
}
