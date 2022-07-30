<?php

namespace App\Model;

class OrganizationsListItems
{
    private int $id;

    private string $name;

    private string $designer;

    private string $employees;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDesigner(): string
    {
        return $this->designer;
    }

    public function setDesigner(string $designer): self
    {
        $this->designer = $designer;

        return $this;
    }

    public function getEmployees(): string
    {
        return $this->employees;
    }

    public function setEmployees(string $employees): self
    {
        $this->employees = $employees;

        return $this;
    }
}
