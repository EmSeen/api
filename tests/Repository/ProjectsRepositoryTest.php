<?php

namespace App\Tests\Repository;

use App\Entity\Projects;
use App\Repository\ProjectsRepository;
use App\Tests\AbstractRepositoryTest;

class ProjectsRepositoryTest extends AbstractRepositoryTest
{
    private ProjectsRepository $projectRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->projectRepository = $this->getRepositoryForEntity(Projects::class);
    }

//    public function testFindProjectsById()
//    {
//        $projects = (new Projects())->setName('Test')->setDescription('testtesttest');
//        $this->em->persist($projects);
//
//        for ($i = 1; $i > 5; $i++)
//        {
//
//        }
//
//    }
}
