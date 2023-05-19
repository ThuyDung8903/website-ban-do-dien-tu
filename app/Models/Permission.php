<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'permissions';
    protected $fillable = [
        'permission',
        'user_id',
        'start_time',
        'end_time',
        'status',
    ];

    public function users()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}