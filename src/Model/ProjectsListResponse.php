<?php

namespace App\Model;

class ProjectsListResponse
{
    /**
     * @var ProjectsListItems[]
     */
    private array $items;

    /**
     * OrganizationsListResponse constructor.
     *
     * @param ProjectsListItems[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return ProjectsListItems[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
