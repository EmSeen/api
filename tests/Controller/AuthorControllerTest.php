<?php

namespace App\Tests\Controller;

use App\Entity\Project;
use App\Entity\User;
use App\Tests\AbstractControllerTest;

class AuthorControllerTest extends AbstractControllerTest
{
    public function testListProjects()
    {
        $this->em->persist(
            (
            new Project())
                ->setName('test')
                ->setDescription('test')
                ->setStartDate(new \DateTime('2022-12-12T12:10:00+00:00'))
                ->setEndDate(new \DateTime('2022-12-12T10:12:00+00:00'))
                ->setUser($this->authAuthor())
        );
        $this->em->flush();

        $this->client->request('GET', '/api/v1/author/listProjects');
        $responseContent = $this->client->getResponse()->getContent();

        $this->assertResponseIsSuccessful();
        $this->assertJsonDocumentMatchesSchema(
            $responseContent,
            $this->shema()
        );
    }

    public function testCreateProject()
    {
        $this->authAuthor();

        $content = json_encode(['name' => 'testName', 'description' => 'testDesigner', 'startDate' => '2022-12-12', 'endDate' => '2022-12-12']);
        $this->client->request('POST', '/api/v1/author/createProject', [], [], [], $content);

        $this->assertResponseIsSuccessful();
    }

    public function testShowProject()
    {
        $this->authAuthor();

        $this->client->request('GET', '/api/v1/author/showProject/2');
        $responseContent = json_decode($this->client->getResponse()->getContent());

        $this->assertResponseIsSuccessful();
        $this->assertJsonDocumentMatchesSchema(
            $responseContent,
            $this->shema()
        );
    }

//    public function testDeleteProject()
//    {
//
//    }

    private function authAuthor(): User
    {
        $username = $this->generateRandomEmail(5);
        $password = 'qwerty123';
        $author = $this->createAuthor($username, $password);
        $this->auth($username, $password);
        return $author;
    }

    private function shema(): array
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
