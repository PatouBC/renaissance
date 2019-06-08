<?php

namespace App\Event;

use App\Entity\User;
use Symfony\Component\EventDispatcher\Event;
use App\Entity\DayPart;

class RdvDemandeEvent extends Event
{
    protected $dayPart;
    protected $user;

    public function __construct(DayPart $dayPart, User $user)
    {
        $this->dayPart = $dayPart;
        $this->user = $user;
    }

    public function getDayPart(): DayPart
    {
        return $this->dayPart;
    }

    public function setDayPart(DayPart $dayPart): self
    {
        $this->dayPart = $dayPart;

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
