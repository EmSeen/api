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
    public function __construct(private ProjectRepository $projectRepository, private EntityManagerInterface $em, private Security $security)
    {
    }

    public function getProjects(): ProjectListResponse
    {
        return new ProjectListResponse(
            array_map(
                [$this, 'map'],
                $this->projectRepository->projectsList()
            )
        );
    }

    public function getProject(int $id): ProjectListResponse
    {
        if (!$this->projectRepository->existById($id)) {
            throw new ProjectNotFoundException();
        }

        return new ProjectListResponse(
            array_map(
                [$this, 'map'],
                $this->projectRepository->findProjectById($id)
            )
        );
    }

    private function map(Project $project): ProjectListItem
    {
        return (new ProjectListItem())
            ->setId($project->getId())
            ->setName($project->getName())
            ->setDescription($project->getDescription())
            ->setStartDate($project->getStartDate())
            ->setEndDate($project->getEndDate());
    }
}
