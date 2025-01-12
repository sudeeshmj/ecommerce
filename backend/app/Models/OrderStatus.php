<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;
    protected $table = 'order_status';
    protected $fillable = ['status'];
    protected function orders()
    {
        return $this->hasMany(Order::class, 'order_status', 'id');
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function orderStatusHistories()
    {
        return $this->hasMany(OrderStatusHistory::class);
    }
}
