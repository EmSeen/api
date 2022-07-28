<?php

namespace App\Tests\Controller;

use App\Entity\Organizations;
use App\Tests\AbstractControllerTest;

class OrganizationsControllerTest extends AbstractControllerTest
{
    public function testList()
    {
        $this->em->persist((new Organizations())->setName('test')->setDesigner('test'));
        $this->em->flush();

        $this->client->request('GET', '/api/v1/listOrganizations');
        $responseContent = json_decode($this->client->getResponse()->getContent(), true);

        $this->assertResponseIsSuccessful();
        $this->assertJsonDocumentMatchesSchema($responseContent, [
            'type' => 'object',
            'required' => ['items'],
            'properties' => [
                'items' => [
                    'type' => 'array',
                    'items' => [
                        'type' => 'object',
                        'required' => ['id', 'name', 'designer'],
                        'properties' => [
                            'names' => ['type' => 'string'],
                            'designer' => ['type' => 'string'],
                            'id' => ['type' => 'integer']
                        ],
                    ],
                ],
            ],
        ]);
    }

}
