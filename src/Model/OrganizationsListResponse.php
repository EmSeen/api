<?php


namespace App\Model;


class OrganizationsListResponse
{
    /**
     * @var OrganizationsListItems[]
     */
    private array $item;

    /**
     * OrganizationsListResponse constructor.
     * @param OrganizationsListItems[] $item
     */
    public function __construct(array $item)
    {
        $this->item = $item;
    }

    /**
     * @return OrganizationsListItems[]
     */
    public function getItem(): array
    {
        return $this->item;
    }

}
