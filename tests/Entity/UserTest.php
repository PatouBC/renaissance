<?php

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    // TEST UNITAIRE
    public function testAddUcFirstForUserFirstName()
    {
        $user = new User();
        $user->setFirstName('Toto');

        // assert that your calculator added the numbers correctly!
        $this->assertEquals('Toto', $user->getFirstName());
    }
}
