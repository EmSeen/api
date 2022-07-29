<?php

namespace App\Service;

use App\Entity\Organizations;
use App\Model\OrganizationsListItems;
use App\Model\OrganizationsListResponse;
use App\Model\OrganizationsRequest;
use App\Repository\OrganizationsRepository;
use Doctrine\ORM\EntityManagerInterface;

class OrganizationsService
{
    public function __construct(private OrganizationsRepository $organizationsRepository, private EntityManagerInterface $em)
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

    public function newOrganization(OrganizationsRequest $organizationsRequest): void
    {
        $organizations = new Organizations();

        $organizations->setName($organizationsRequest->getName());
        $organizations->setDesigner($organizationsRequest->getDesigner());
        $organizations->setEmployees($organizationsRequest->getEmployees());

        $this->em->persist($organizations);
        $this->em->flush();
    }
}
