<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $table = 'images';
    protected $fillable = [
        'name',
        'path',
        'product_id',
        'is_thumbnail',
    ];

    public function products()
    {
        $this->hasOne(Product::class, 'id', 'product_id');
    }
}
