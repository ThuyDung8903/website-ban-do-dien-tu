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
        return $this->hasMany(ProductAttributeValue::class, 'product_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'product_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id', 'id');
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class, 'product_id', 'id');
    }

    public function categories()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id', 'id');
    }
    public function brands()
    {
        return $this->belongsTo(Brand::class,'brand_id', 'id');
    }
}
