<?php

namespace App\Entity;

use App\Repository\OrganizationsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrganizationsRepository::class)]
class Organizations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'string', length: 255)]
    private string $designer;

    #[ORM\Column(type: 'string', length: 255)]
    private string $employees;

    public function getId(): int
    {
        return $this->id;
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
