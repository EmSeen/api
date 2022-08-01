<?php

namespace App\Service;

use App\Entity\Project;
use App\Exception\ProjectNotFoundException;
use App\Mapper\ProjectMapper;
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
                fn (Project $project) => ProjectMapper::map($project, new ProjectListItem()),
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
                fn (Project $project) => ProjectMapper::map($project, new ProjectListItem()),
                $this->projectRepository->projectById($id)
            )
        );
    }
}
