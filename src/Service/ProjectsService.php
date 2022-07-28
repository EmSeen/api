<?php

namespace App\Service;

use App\Entity\Projects;
use App\Exception\ProjectNotFoundException;
use App\Model\ProjectsListItems;
use App\Model\ProjectsListResponse;
use App\Repository\ProjectsRepository;

class ProjectsService
{
    public function __construct(private ProjectsRepository $projectsRepository)
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
        $projectOrig = $this->projectsRepository->find($id);

        if (null === $projectOrig) {
            throw new ProjectNotFoundException();
        }

        return new ProjectsListResponse(
            array_map(
                [$this, 'map'],
                $this->projectsRepository->findProjectsById($id)
            )
        );
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
