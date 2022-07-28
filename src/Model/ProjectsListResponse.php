<?php

namespace App\Model;

class ProjectsListResponse
{
    /**
     * @var ProjectsListItems[]
     */
    private array $item;

    /**
     * OrganizationsListResponse constructor.
     *
     * @param ProjectsListItems[] $item
     */
    public function __construct(array $item)
    {
        $this->item = $item;
    }

    /**
     * @return ProjectsListItems[]
     */
    public function getItem(): array
    {
        return $this->item;
    }
}
