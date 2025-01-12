<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderCancellation extends Model
{
    use HasFactory;
    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }
    public function cancellationReason()
    {
        return $this->belongsTo(CancellationReason::class);
    }
}
