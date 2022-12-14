<?php

namespace App\Tests\Controller;

use App\Entity\Project;
use App\Tests\AbstractControllerTest;

class ProjectControllerTest extends AbstractControllerTest
{
    public function testListProjects(): void
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

        $this->client->request('GET', '/api/v1/listProjects');
        $responseContent = $this->client->getResponse()->getContent();

        $this->assertResponseIsSuccessful();
        $this->assertJsonDocumentMatchesSchema(
            $responseContent,
            $this->sheme()
        );
    }

    public function testShowProject(): void
    {
        $this->client->request('GET', '/api/v1/showProject/2');
        $responseContent = json_decode($this->client->getResponse()->getContent(), true);

        $this->assertResponseIsSuccessful();
        $this->assertJsonDocumentMatchesSchema(
            $responseContent,
            $this->sheme()
        );
    }

    private function sheme(): array
    {
        return [
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
        ];
    }
}
