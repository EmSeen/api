<?php

namespace App\Service;

use App\Entity\Organizations;
use App\Exception\OrganizationNotFoundException;
use App\Model\OrganizationsListItems;
use App\Model\OrganizationsListResponse;
use App\Model\OrganizationsRequest;
use App\Repository\OrganizationsRepository;
use Doctrine\ORM\EntityManagerInterface;

class OrganizationsService
{
    public function __construct(
        private OrganizationsRepository $organizationsRepository,
        private EntityManagerInterface $em
    ) {
    }

    public function getOrganizations(): OrganizationsListResponse
    {
        return new OrganizationsListResponse(
            array_map(
                [$this, 'map'],
                $this->organizationsRepository->organizationsList()
            )
        );
    }

    public function getOrganization(int $id): OrganizationsListResponse
    {
        if (!$this->organizationsRepository->existById($id)) {
            throw new OrganizationNotFoundException();
        }

        return new OrganizationsListResponse(
            array_map(
                [$this, 'map'],
                $this->organizationsRepository->findOrganizationById($id)
            )
        );
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

    private function map(Organizations $organizations): OrganizationsListItems
    {
        return (new OrganizationsListItems())
            ->setId($organizations->getId())
            ->setName($organizations->getName())
            ->setDesigner($organizations->getDesigner())
            ->setEmployees($organizations->getEmployees());
    }
}
