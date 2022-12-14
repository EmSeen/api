<?php

namespace App\Tests\Controller;

use App\Entity\Organization;
use App\Tests\AbstractControllerTest;

class OrganizationControllerTest extends AbstractControllerTest
{
    public function testListOrganization(): void
    {
        $this->em->persist(
            (
            new Organization())
                ->setName('test')
                ->setDesigner('test')
                ->setEmployees('q')
        );
        $this->em->flush();

        $this->client->request('GET', '/api/v1/listOrganizations');
        $responseContent = $this->client->getResponse()->getContent();

        $this->assertResponseIsSuccessful();
        $this->assertJsonDocumentMatchesSchema(
            $responseContent,
            [
                'type' => 'object',
                'required' => ['items'],
                'properties' => [
                    'items' => [
                        'type' => 'array',
                        'items' => [
                            'type' => 'object',
                            'required' => ['id', 'name', 'designer', 'employees'],
                            'properties' => [
                                'names' => ['type' => 'string'],
                                'designer' => ['type' => 'string'],
                                'employees' => ['type' => 'string'],
                                'id' => ['type' => 'integer']
                            ],
                        ],
                    ],
                ],
            ]
        );
    }

    public function testShowOrganization(): void
    {
        $this->client->request('GET', '/api/v1/showOrganization/1');
        $responseContent = json_decode($this->client->getResponse()->getContent(), true);

        $this->assertResponseIsSuccessful();
        $this->assertJsonDocumentMatchesSchema(
            $responseContent,
            [
                'type' => 'object',
                'required' => ['items'],
                'properties' => [
                    'items' => [
                        'type' => 'array',
                        'items' => [
                            'type' => 'object',
                            'required' => ['id', 'name', 'designer', 'employees'],
                            'properties' => [
                                'names' => ['type' => 'string'],
                                'designer' => ['type' => 'string'],
                                'employees' => ['type' => 'string'],
                                'id' => ['type' => 'integer']
                            ],
                        ],
                    ],
                ],
            ]
        );
    }

    public function testCreateOrganization(): void
    {
        $content = json_encode(['name' => 'testName', 'designer' => 'testDesigner', 'employees' => 'testEmployees']);
        $this->client->request('POST', '/api/v1/createOrganization', [], [], [], $content);

        $this->assertResponseIsSuccessful();
    }

}
