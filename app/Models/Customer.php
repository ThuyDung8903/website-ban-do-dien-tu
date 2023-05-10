<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';
    protected $fillable = [
        'username',
        'password',
        'fullname',
        'gender',
        'email',
        'phone',
        'address',
        'avatar',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders(){
        $this->hasMany(Order::class, 'customer_id', 'id');
    }

    public function reviews()
    {
        $this->hasMany(Review::class, 'customer_id', 'id');
    }
}
