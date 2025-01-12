<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


class OutOfStockEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $book;
    public function __construct($book)
    {
        $this->book = $book;
      
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
