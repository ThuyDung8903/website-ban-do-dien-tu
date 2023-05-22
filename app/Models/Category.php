<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'parent_id',
        'status',
        'slug',
        'description',
        'image',
        'meta_title',
        'meta_keywords',
        'meta_description'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    //function brands() get all brand of products in a category
    public function brands()
    {
        return $this->hasManyThrough(Brand::class, Product::class, 'category_id', 'id', 'id', 'brand_id');
    }
}
