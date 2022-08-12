<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\PostDeleting as PostDeletingEvent;

class PostDeleting
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
     * @param  \App\Events\PostDeleting  $event
     * @return mixed
     */
    public function handle(PostDeletingEvent $event)
    {
        $event->post->comments->delete();
    }
}
