<?php

namespace App\Model;

class OrganizationsListResponse
{
    /**
     * @var OrganizationsListItems[]
     */
    private array $items;

    /**
     * OrganizationsListResponse constructor.
     *
     * @param OrganizationsListItems[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return OrganizationsListItems[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
