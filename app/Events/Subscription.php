<?php

namespace App\Events;

use App\Events\Event;
use App\Subscribe;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Subscription extends Event
{
    use SerializesModels;
    public $title;
    public $inserted_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($title, $inserted_id)
    {
       $this->title = $title;
       $this->inserted_id = $inserted_id;
    }
   

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
