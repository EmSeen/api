<?php

namespace App\Tests\Controller;

use App\Entity\Organizations;
use App\Entity\Projects;
use App\Tests\AbstractControllerTest;

class ProjectsControllerTest extends AbstractControllerTest
{

    public function testList(): void
    {
        $this->em->persist((
            new Projects())
            ->setName('test')
            ->setDescription('test')
            ->setStartDate(new \DateTime('2022-12-12T12:10:00+00:00'))
            ->setEndDate(new \DateTime('2022-12-12T10:12:00+00:00')));
        $this->em->flush();

        $this->client->request('GET', '/api/v1/listProjects');
        $responseContent = $this->client->getResponse()->getContent();

        $this->assertResponseIsSuccessful();
        $this->assertJsonDocumentMatchesSchema($responseContent, [
            'type' => 'object',
            'required' => ['items'],
            'properties' => [
                'items' => [
                    'type' => 'array',
                    'items' => [
                        'type' => 'object',
                        'required' => ['id', 'name', 'description', 'startDate', 'endDate'],
                        'properties' => [
                            'names' => ['type' => 'string'],
                            'description' => ['type' => 'string'],
                            'startDate' => ['type' => 'string'],
                            'endDate' => ['type' => 'string'],
                            'id' => ['type' => 'integer']
                        ],
                    ],
                ],
            ],
        ]);
    }

    public function testShow(): void
    {
        $this->client->request('GET', '/api/v1/showProjects/5');
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
                        'required' => ['id', 'name', 'description', 'startDate', 'endDate'],
                        'properties' => [
                            'names' => ['type' => 'string'],
                            'description' => ['type' => 'string'],
                            'startDate' => ['type' => 'string'],
                            'endDate' => ['type' => 'string'],
                            'id' => ['type' => 'integer']
                        ],
                    ],
                ],
            ],
        ]);
    }

}
