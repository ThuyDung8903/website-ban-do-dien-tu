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
        $this->hasMany(Product::class, 'category_id', 'id');
    }
}
