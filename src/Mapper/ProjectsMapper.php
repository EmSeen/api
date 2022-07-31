<?php

namespace App\Mapper;

use App\Entity\Projects;
use App\Model\ProjectsDetails;
use App\Model\ProjectsListItem;

class ProjectsMapper
{
    public static function map(Projects $projects, ProjectsDetails|ProjectsListItem $model): ProjectsDetails|ProjectsListItem
    {
        return $model
            ->setId($projects->getId())
            ->setName($projects->getName())
            ->setDescription($projects->getDescription())
            ->setStartDate($projects->getStartDate())
            ->setEndDate($projects->getEndDate());
    }
}
