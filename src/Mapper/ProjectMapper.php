<?php

namespace App\Mapper;

use App\Entity\Project;
use App\Model\ProjectDetails;
use App\Model\ProjectListItem;

class ProjectMapper
{
    public static function map(Project $projects, ProjectDetails|ProjectListItem $model): ProjectDetails|ProjectListItem
    {
        return $model
            ->setId($projects->getId())
            ->setName($projects->getName())
            ->setDescription($projects->getDescription())
            ->setStartDate($projects->getStartDate())
            ->setEndDate($projects->getEndDate());
    }
}
