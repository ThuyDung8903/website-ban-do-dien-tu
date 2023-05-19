<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Notifications\Notifiable;

class Customer extends Model implements Authenticatable
{
    use HasFactory, Notifiable;
    use AuthenticableTrait;
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
