<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Customer extends Model implements JWTSubject
{
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    use HasFactory;
    protected $casts = [
        'otp_created_at' => 'datetime',
    ];
    protected $hidden = [
        'otp',
        'otp_created_at',
    ];
    protected $fillable = ['customer_name', 'image', 'email', 'phone_number', 'otp', 'otp_created_at', 'status'];
}
