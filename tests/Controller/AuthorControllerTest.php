<?php

namespace App\Tests\Controller;

use App\Entity\Project;
use App\Tests\AbstractControllerTest;

class AuthorControllerTest extends AbstractControllerTest
{

    public function testProjects()
    {
        $this->em->persist(
            (
            new Project())
                ->setName('test')
                ->setDescription('test')
                ->setStartDate(new \DateTime('2022-12-12T12:10:00+00:00'))
                ->setEndDate(new \DateTime('2022-12-12T10:12:00+00:00'))
                ->setUser($this->getUser())
        );
        $this->em->flush();

        $this->client->request('GET', '/api/v1/author/projects');
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
            ]
        );
    }

    public function testCreateProject()
    {

    }

    public function testDeleteProject()
    {

    }
}
