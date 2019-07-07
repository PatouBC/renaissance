<?php

namespace App\Event;

use App\Entity\User;
use Symfony\Component\EventDispatcher\Event;
use App\Entity\Message;

class MessageSentEvent extends Event
{
    protected $message;
    protected $user;

    public function __construct(Message $message)
    {
        $this->message = $message;

    }
    public function getMessage(): Message
    {
        return $this->message;
    }

    public function setDayPart(Message $message): self
    {
        $this->message = $message;

        return $this;
    }
    public function getUser():User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }
}