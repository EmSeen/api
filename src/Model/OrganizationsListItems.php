<?php


namespace App\Model;


class OrganizationsListItems
{
    private int $id;

    private string $name;

    private string $designer;

    /**
     * OrganizationsListItems constructor.
     * @param int $id
     * @param string $name
     * @param string $designer
     */
    public function __construct(int $id, string $name, string $designer)
    {
        $this->id = $id;
        $this->name = $name;
        $this->designer = $designer;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDesigner(): string
    {
        return $this->designer;
    }

}
