<?php

namespace App\Service;

use App\Entity\Project;
use App\Exception\ProjectNotFoundException;
use App\Mapper\ProjectMapper;
use App\Model\Author\CreateProjectRequest;
use App\Model\Author\ProjectListResponse;
use App\Model\IdResponse;
use App\Model\ProjectDetails;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Security;

class AuthorService
{
    public function __construct(private EntityManagerInterface $em,
                                private ProjectRepository $projectRepository,
                                private Security $security)
    {
    }

    public function getProject(int $id): ProjectListResponse
    {
        $user = $this->security->getUser();

        if (!$this->projectRepository->existById($id)) {
            throw new ProjectNotFoundException();
        }

        if (!$this->projectRepository->existsByUser($id, $user)) {
            throw new AccessDeniedException('Access denied');
        }

        return new ProjectListResponse(
            array_map(
                fn (Project $project) => ProjectMapper::map($project, new ProjectDetails()),
                $this->projectRepository->getUserProjectsById($id, $user)
            )
        );
    }

    public function getProjects(): ProjectListResponse
    {
        $user = $this->security->getUser();

        return new ProjectListResponse(
            array_map(
                fn (Project $project) => ProjectMapper::map($project, new ProjectDetails()),
                $this->projectRepository->userProjects($user)
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
        if (!$this->projectRepository->existById($id)) {
            throw new ProjectNotFoundException();
        }

        $project = $this->projectRepository->delUserProjectsById($id, $this->security->getUser());

        $this->em->remove($project);
        $this->em->flush();
    }
}
