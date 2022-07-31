<?php

namespace App\Model;

class OrganizationListResponse
{
    /**
     * @var OrganizationListItems[]
     */
    private array $items;

    /**
     * OrganizationsListResponse constructor.
     *
     * @param OrganizationListItems[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return OrganizationListItems[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
