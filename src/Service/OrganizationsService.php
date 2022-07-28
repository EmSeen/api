<?php

namespace App\Service;

use App\Entity\Organizations;
use App\Model\OrganizationsListItems;
use App\Model\OrganizationsListResponse;
use App\Repository\OrganizationsRepository;

class OrganizationsService
{
    public function __construct(private OrganizationsRepository $organizationsRepository)
    {
    }

    public function getOrganizations(): OrganizationsListResponse
    {
        $organizationsOrig = $this->organizationsRepository->findAllSortedByName();
        $items = array_map(
            fn (Organizations $organizations) => new OrganizationsListItems(
                $organizations->getId(), $organizations->getName(), $organizations->getDesigner()
            ),
            $organizationsOrig
        );

        return new OrganizationsListResponse($items);
    }
}
