<?php

namespace App\Events;

use App\ContactFile;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ContactsStored implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var \App\ContactFile
     */
    protected $contactFile;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ContactFile $contactFile)
    {
        $this->contactFile = $contactFile;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel("App.ContactFile.{$this->contactFile->id}");
    }
}
