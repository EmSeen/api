<?php

namespace App\Model\Author;

class ProjectListResponse
{
    /**
     * @var ProjectListItems[]
     */
    private array $items;

    /**
     * ProjectListResponse constructor.
     *
     * @param ProjectListItems[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return ProjectListItems[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
