<?php


namespace App\Service;


use App\Entity\Organizations;
use App\Model\OrganizationsListItems;
use App\Model\OrganizationsListResponse;
use App\Repository\OrganizationsRepository;
use Doctrine\Common\Collections\Criteria;

class OrganizationsService
{

    public function __construct(private OrganizationsRepository $organizationsRepository)
    {

    }

    public function getOrganizations(): OrganizationsListResponse
    {
        $organizationsOrig = $this->organizationsRepository->findBy([], ['name' => Criteria::ASC]);
        $items = array_map(
            fn(Organizations $organizations) => new OrganizationsListItems(
                $organizations->getId(), $organizations->getName(), $organizations->getDesigner()
            ),
            $organizationsOrig
        );
        return new OrganizationsListResponse($items);
    }
}
