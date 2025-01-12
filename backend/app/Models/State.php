<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    protected function deliveryAddresses()
    {
        return $this->hasMany(DeliveryAddress::class);
    }
    protected function orderShippingAddresses()
    {
        return $this->hasMany(OrderShippingAddress::class);
    }
}
