<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class OrganizationsControllerTest extends WebTestCase
{
    public function testOrganizations(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/v1/organizations');
        $responseContent = $client->getResponse()->getContent();

        $this->assertResponseIsSuccessful();
        $this->assertJsonStringEqualsJsonFile(
            __DIR__.'/response/OrganizationsControllerTest_testOrganizations.json',
            $responseContent
        );
    }
}
