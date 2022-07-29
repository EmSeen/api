<?php

namespace App\Service;

use App\Entity\Projects;
use App\Exception\ProjectNotFoundException;
use App\Model\ProjectRequest;
use App\Model\ProjectsListItems;
use App\Model\ProjectsListResponse;
use App\Repository\ProjectsRepository;
use Doctrine\ORM\EntityManagerInterface;

class ProjectsService
{
    public function __construct(private ProjectsRepository $projectsRepository, private EntityManagerInterface $em)
    {
    }

    public function getProjects(): ProjectsListResponse
    {
        return new ProjectsListResponse(
            array_map(
                [$this, 'map'],
                $this->projectsRepository->projectsList()
            )
        );
    }

    public function getProject(int $id): ProjectsListResponse
    {
        if (!$this->projectsRepository->existById($id)) {
            throw new ProjectNotFoundException();
        }

        return new ProjectsListResponse(
            array_map(
                [$this, 'map'],
                $this->projectsRepository->findProjectById($id)
            )
        );
    }

    public function newProject(ProjectRequest $projectsRequest): void
    {
        $project = new Projects();

        $project->setName($projectsRequest->getName());
        $project->setDescription($projectsRequest->getDescription());
        $project->setStartDate($projectsRequest->getStartDate());
        $project->setEndDate($projectsRequest->getEndDate());

        $this->em->persist($project);
        $this->em->flush();
    }

    private function map(Projects $projects): ProjectsListItems
    {
        return (new ProjectsListItems())
            ->setId($projects->getId())
            ->setName($projects->getName())
            ->setDescription($projects->getDescription())
            ->setStartDate($projects->getStartDate())
            ->setEndDate($projects->getEndDate());
    }
}
