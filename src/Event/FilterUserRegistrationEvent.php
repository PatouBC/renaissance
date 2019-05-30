<?php

namespace App\Event;


use App\Entity\User;
use FOS\UserBundle\Event\UserEvent;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\Request;

class FilterUserRegistrationEvent extends UserEvent
{
    /**
     * CreatedUserEvent constructor.
     *
     * @param UserInterface $user
     * @param Request       $request
     */
    public function __construct(UserInterface $user, Request $request)
    {
        parent::__construct($user, $request);
    }

}