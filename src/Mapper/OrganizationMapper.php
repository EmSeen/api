<?php

namespace App\Mapper;

use App\Entity\Organization;
use App\Model\OrganizationListItems;

class OrganizationMapper
{
    public static function map(Organization $organization, OrganizationListItems $model): OrganizationListItems
    {
        return $model
            ->setId($organization->getId())
            ->setName($organization->getName())
            ->setDesigner($organization->getDesigner())
            ->setEmployees($organization->getEmployees());
    }
}
