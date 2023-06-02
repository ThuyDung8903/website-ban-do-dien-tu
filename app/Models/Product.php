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
        'quantity',
        'slug',
        'short_description',
        'detail_description',
        'view',
        'total_sold',
        'status',
        'trending',
        'meta_title',
        'meta_keyword',
        'meta_description',
    ];

    public function product_attribute_values()
    {
        return $this->hasMany(ProductAttributeValue::class, 'product_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'product_id', 'id');
    }

    public function review()
    {
        return $this->hasMany(Review::class, 'product_id', 'id');
    }

    public function order_detail()
    {
        return $this->hasMany(OrderDetail::class, 'product_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }
}