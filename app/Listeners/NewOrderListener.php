<?php

namespace App\Listeners;

use App\Events\NewOrderEvent;
use App\Models\Product;
use App\Notifications\NewOrderNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewOrderListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param NewOrderEvent $event
     * @return void
     */
    public function handle(NewOrderEvent $event)
    {
        $owners = $event->order->products->map(function (Product $product) {
            return $product->place->owner;
        })->unique();


        \Notification::send($owners,new NewOrderNotification($event->order));
    }
}
