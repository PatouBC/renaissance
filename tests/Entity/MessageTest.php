<?php

namespace App\Tests\Entity;

use App\Entity\Message;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class MessageTest extends TestCase
{
    public function testIfContentIsset()
    {
        $message = new Message();
        $message->setMessage('Ceci est le test unitaire de Message');
        $this->assertEquals('Ceci est le test unitaire de Message', $message->getMessage());
    }

    public function testIfUserIsAdded()
    {
        $user = new User();
        $user->setUsername('Testeur');
        $message = new Message();
        $message->setUser($user);
        $this->assertEquals('Testeur', $message->getUser()->getUsername());
    }
}