<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CallCandidateEndEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct($candidate_i)
    {
        $this->candidate_id = $candidate_i;
    }

    public $candidate_id;

    /**
     * Get the data to broadcast.
     *
     * @return array<string, mixed>
     */

    public function broadcastWith(): array
    {
        return [
            'candidate_id' => $this->candidate_id,
        ];
    }

    public function broadcastAs()
    {
        return 'callCandidateEnd';
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('call-candidate-end'),
        ];
    }
}
