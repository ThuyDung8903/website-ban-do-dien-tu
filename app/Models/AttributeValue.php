<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;
    protected $table = 'attribute_values';

    protected $fillable = [
        'value',
        'attribute_id',
        'status',
    ];

    public function attribute()
    {
        return $this->hasOne(Attribute::class, 'id', 'attribute_value');
    }
}