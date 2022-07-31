<?php

namespace App\Service;

use App\Entity\Project;
use App\Model\Author\CreateProjectRequest;
use App\Model\Author\ProjectsListResponse;
use App\Model\Author\ProjectsListItems;
use App\Model\IdResponse;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class AuthorService
{
    public function __construct(private EntityManagerInterface $em,
                                private ProjectRepository $projectsRepository,
                                private Security $security)
    {
    }

    public function getProjects(): ProjectsListResponse
    {
        $user = $this->security->getUser();

        return new ProjectsListResponse(
            array_map(
                [$this, 'map'],
                $this->projectsRepository->findUserProjects($user)
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
        $book = $this->projectsRepository->getUserProjectsById($id, $this->security->getUser());

        $this->em->remove($book);
        $this->em->flush();
    }

    private function map(Project $projects): ProjectsListItems
    {
        return (new ProjectsListItems())
            ->setId($projects->getId())
            ->setName($projects->getName())
            ->setDescription($projects->getDescription())
            ->setStartDate($projects->getStartDate())
            ->setEndDate($projects->getEndDate());
    }
}
