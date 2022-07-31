<?php

namespace App\Model;

class ProjectsListResponse
{
    /**
     * @var ProjectsListItem[]
     */
    private array $items;

    /**
     * OrganizationsListResponse constructor.
     *
     * @param ProjectsListItem[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return ProjectsListItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
