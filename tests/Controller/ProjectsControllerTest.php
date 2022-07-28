<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjectsControllerTest extends WebTestCase
{

    public function testList(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/v1/listProjects');
        $responseContent = $client->getResponse()->getContent();

        $this->assertResponseIsSuccessful();
        $this->assertJsonStringEqualsJsonFile(
            __DIR__.'/response/ProjectsControllerTest_testList.json',
            $responseContent
        );
    }

    public function testShow(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/v1/showProjects/24');
        $responseContent = $client->getResponse()->getContent();

        $this->assertResponseIsSuccessful();
        $this->assertJsonStringEqualsJsonFile(
            __DIR__.'/response/ProjectsControllerTest_testShow.json',
            $responseContent
        );
    }

}
