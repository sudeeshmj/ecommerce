<?php

namespace App\Listeners;

use App\Events\OutOfStockEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\OutOfStockMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendAdminMailListener implements ShouldQueue
{
    use InteractsWithQueue;
    public function __construct()
    {
       
    }
    public function handle(OutOfStockEvent $event)
    { 
        Mail::to('sudeeshmj@gmail.com')
            ->send(new OutOfStockMail($event->book));

    }
}
