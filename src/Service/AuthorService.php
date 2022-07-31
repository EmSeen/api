<?php

namespace App\Service;

use App\Entity\Project;
use App\Model\Author\CreateProjectRequest;
use App\Model\Author\ProjectListResponse;
use App\Model\Author\ProjectListItems;
use App\Model\IdResponse;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class AuthorService
{
    public function __construct(private EntityManagerInterface $em,
                                private ProjectRepository $projectRepository,
                                private Security $security)
    {
    }

    public function getProjects(): ProjectListResponse
    {
        $user = $this->security->getUser();

        return new ProjectListResponse(
            array_map(
                [$this, 'map'],
                $this->projectRepository->findUserProjects($user)
            )
        );
    }

    public function createProject(CreateProjectRequest $projectRequest): IdResponse
    {
        $project = (new Project())
            ->setName($projectRequest->getName())
            ->setUser($this->security->getUser());

        $this->em->persist($project);
        $this->em->flush();

        return new IdResponse($project->getId());
    }

    public function deleteProject(int $id): void
    {
        $book = $this->projectRepository->getUserProjectsById($id, $this->security->getUser());

        $this->em->remove($book);
        $this->em->flush();
    }

    private function map(Project $project): ProjectListItems
    {
        return (new ProjectListItems())
            ->setId($project->getId())
            ->setName($project->getName())
            ->setDescription($project->getDescription())
            ->setStartDate($project->getStartDate())
            ->setEndDate($project->getEndDate());
    }
}
