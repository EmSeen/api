<?php

namespace App\Service;

use App\Entity\Project;
use App\Exception\ProjectNotFoundException;
use App\Model\ProjectRequest;
use App\Model\ProjectListItem;
use App\Model\ProjectListResponse;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class ProjectService
{
    public function __construct(private ProjectRepository $projectsRepository, private EntityManagerInterface $em, private Security $security)
    {
    }

    public function getProjects(): ProjectListResponse
    {
        return new ProjectListResponse(
            array_map(
                [$this, 'map'],
                $this->projectsRepository->projectsList()
            )
        );
    }

    public function getProject(int $id): ProjectListResponse
    {
        if (!$this->projectsRepository->existById($id)) {
            throw new ProjectNotFoundException();
        }

        return new ProjectListResponse(
            array_map(
                [$this, 'map'],
                $this->projectsRepository->findProjectById($id)
            )
        );
    }

    public function newProject(ProjectRequest $projectsRequest): void
    {
        $project = new Project();

        $project->setName($projectsRequest->getName());
        $project->setDescription($projectsRequest->getDescription());
        $project->setStartDate($projectsRequest->getStartDate());
        $project->setEndDate($projectsRequest->getEndDate());
        $project->setUser($this->security->getUser());

        $this->em->persist($project);
        $this->em->flush();
    }

    private function map(Project $projects): ProjectListItem
    {
        return (new ProjectListItem())
            ->setId($projects->getId())
            ->setName($projects->getName())
            ->setDescription($projects->getDescription())
            ->setStartDate($projects->getStartDate())
            ->setEndDate($projects->getEndDate());
    }
}
