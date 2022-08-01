<?php

namespace App\Tests\Controller;

use App\Tests\AbstractControllerTest;

class AdminControllerTest extends AbstractControllerTest
{
    public function testGrantAuthor(): void
    {
//        $user = $this->createUser($this->generateRandomEmail(5), 'qwerty123');

        $username = $this->generateRandomEmail(5);
        $password = 'qwerty123';
        $this->createAdmin($username, $password);
        $this->auth($username, $password);
        $this->client->request('POST', '/api/v1/admin/grantAuthor/'.$this->getUser()->getId());

        $this->assertResponseIsSuccessful();
    }
}
