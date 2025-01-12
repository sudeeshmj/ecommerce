<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'total_amount',
        'order_amount',
        'shipping_charge',
        'discount',
        'payment_type',
        'payment_status',
        'transaction_id',
        'order_status'

    ];
    protected $appends = ['order_date', 'payment_status_text', 'order_status_text'];

    public function getOrderDateAttribute()
    {
        return Carbon::parse($this->created_at)->format('M d, Y, h:i A');
    }


    public function getOrderStatusTextAttribute()
    {
        return $this->orderStatus ? $this->orderStatus->status : 'Unknown';
    }


    public function getPaymentStatusTextAttribute()
    {
        return $this->payment_status == 1 ? 'Paid' : 'Unpaid';
    }
    public function customer()
    {
        return $this->belongsTo(User::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function orderShippingAddress()
    {
        return $this->hasOne(OrderShippingAddress::class, 'order_id', 'id');
    }
    public function orderStatusHistories()
    {
        return $this->hasMany(OrderStatusHistory::class);
    }
    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status', 'id');
    }
}
