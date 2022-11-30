<?php

namespace App\Listeners;

use App\Events\NewCommentForOwnerEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewCommentForOwnerListener
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
     * @param NewCommentForOwnerEvent $event
     * @return void
     */
    public function handle(NewCommentForOwnerEvent $event)
    {
        dd($event->comment->commentable);
    }
}
