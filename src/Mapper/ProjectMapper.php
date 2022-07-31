<?php

namespace App\Mapper;

use App\Entity\Project;
use App\Model\ProjectDetails;
use App\Model\ProjectListItem;

class ProjectMapper
{
    public static function map(Project $project, ProjectDetails|ProjectListItem $model): ProjectDetails|ProjectListItem
    {
        return $model
            ->setId($project->getId())
            ->setName($project->getName())
            ->setDescription($project->getDescription())
            ->setStartDate($project->getStartDate())
            ->setEndDate($project->getEndDate());
    }
}
