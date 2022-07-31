<?php

namespace App\Service;

use App\Entity\Organization;
use App\Exception\OrganizationNotFoundException;
use App\Model\OrganizationListItems;
use App\Model\OrganizationListResponse;
use App\Model\OrganizationRequest;
use App\Repository\OrganizationRepository;
use Doctrine\ORM\EntityManagerInterface;

class OrganizationService
{
    public function __construct(
        private OrganizationRepository $organizationsRepository,
        private EntityManagerInterface $em
    ) {
    }

    public function getOrganizations(): OrganizationListResponse
    {
        return new OrganizationListResponse(
            array_map(
                [$this, 'map'],
                $this->organizationsRepository->organizationsList()
            )
        );
    }

    public function getOrganization(int $id): OrganizationListResponse
    {
        if (!$this->organizationsRepository->existById($id)) {
            throw new OrganizationNotFoundException();
        }

        return new OrganizationListResponse(
            array_map(
                [$this, 'map'],
                $this->organizationsRepository->findOrganizationById($id)
            )
        );
    }

    public function newOrganization(OrganizationRequest $organizationsRequest): void
    {
        $organizations = new Organization();

        $organizations->setName($organizationsRequest->getName());
        $organizations->setDesigner($organizationsRequest->getDesigner());
        $organizations->setEmployees($organizationsRequest->getEmployees());

        $this->em->persist($organizations);
        $this->em->flush();
    }

    private function map(Organization $organizations): OrganizationListItems
    {
        return (new OrganizationListItems())
            ->setId($organizations->getId())
            ->setName($organizations->getName())
            ->setDesigner($organizations->getDesigner())
            ->setEmployees($organizations->getEmployees());
    }
}
