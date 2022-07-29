<?php

namespace App\Model;

class OrganizationsRequest
{
    private string $name;

    private string $designer;

    private string $employees;

    public function __toString(): string
    {
        return $this->name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDesigner(): string
    {
        return $this->designer;
    }

    public function setDesigner(string $designer): void
    {
        $this->designer = $designer;
    }

    public function getEmployees(): string
    {
        return $this->employees;
    }

    public function setEmployees(string $employees): void
    {
        $this->employees = $employees;
    }
}
