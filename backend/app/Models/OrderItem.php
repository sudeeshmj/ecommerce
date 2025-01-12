<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class);
    }
    public function cancellation()
    {
        return $this->hasOne(OrderCancellation::class);
    }
}
