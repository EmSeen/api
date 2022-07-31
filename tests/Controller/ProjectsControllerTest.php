<?php

namespace App\Tests\Controller;

use App\Entity\Project;
use App\Entity\User;
use App\Tests\AbstractControllerTest;

class ProjectsControllerTest extends AbstractControllerTest
{
    public function testList(): void
    {
        $this->em->persist(
            (
            new Project())
            ->setName('test')
            ->setDescription('test')
            ->setStartDate(new \DateTime('2022-12-12T12:10:00+00:00'))
            ->setEndDate(new \DateTime('2022-12-12T10:12:00+00:00'))
        );
        $this->em->flush();

        $this->client->request('GET', '/api/v1/listProjects');
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

    public function testShow(): void
    {
        $this->client->request('GET', '/api/v1/showProject/1');
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

    public function testNew(): void
    {
        $content = json_encode(['name' => 'testName', 'description' => 'testDescription', 'startDate' => '2022-12-12', 'endDate' => '2022-12-12']);
        $this->client->request('POST', '/api/v1/newProject', [], [], [], $content);

        $this->assertResponseIsSuccessful();
    }
}
