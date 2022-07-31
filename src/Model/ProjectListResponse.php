<?php

namespace App\Model;

class ProjectListResponse
{
    /**
     * @var ProjectListItem[]
     */
    private array $items;

    /**
     * ProjectListResponse constructor.
     *
     * @param ProjectListItem[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return ProjectListItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
