<?php

namespace App\Service;

use App\Entity\Organization;
use App\Exception\OrganizationNotFoundException;
use App\Mapper\OrganizationMapper;
use App\Model\OrganizationListItems;
use App\Model\OrganizationListResponse;
use App\Model\OrganizationRequest;
use App\Repository\OrganizationRepository;
use Doctrine\ORM\EntityManagerInterface;

class OrganizationService
{
    public function __construct(
        private OrganizationRepository $organizationRepository,
        private EntityManagerInterface $em
    )
    {
    }

    public function getOrganizations(): OrganizationListResponse
    {
        return new OrganizationListResponse(
            array_map(
                fn (Organization $organization) => OrganizationMapper::map($organization, new OrganizationListItems()),
                $this->organizationRepository->organizationsList()
            )
        );
    }

    public function getOrganization(int $id): OrganizationListResponse
    {
        if (!$this->organizationRepository->existById($id)) {
            throw new OrganizationNotFoundException();
        }

        return new OrganizationListResponse(
            array_map(
                fn (Organization $organization) => OrganizationMapper::map($organization, new OrganizationListItems()),
                $this->organizationRepository->findOrganizationById($id)
            )
        );
    }

    public function newOrganization(OrganizationRequest $organizationRequest): void
    {
        $organization = new Organization();

        $organization->setName($organizationRequest->getName());
        $organization->setDesigner($organizationRequest->getDesigner());
        $organization->setEmployees($organizationRequest->getEmployees());

        $this->em->persist($organization);
        $this->em->flush();
    }
}
