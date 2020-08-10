<?php

namespace App\Events;

use App\Models\Proposal;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class StoreAlert
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $email;
    public $proposals;
    public $urls;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($email, $proposals, $urls)
    {
        $this->email = $email;
        $this->proposals = $proposals;
        $this->urls = $urls;
    }
}
