<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        "customer_id",
        "name",
        "phone_number",
        "pincode",
        "locality",
        "address",
        "city",
        "state_id",
        "landmark",
        "address_type",
        "default_address"
    ];
    protected $hidden = ['created_at', 'updated_at'];
    public function customer()
    {
        return $this->belongsTo(User::class);
    }
    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
