<?php


namespace App\Model\Author;


use Symfony\Component\Validator\Constraints\NotBlank;

class CreateProjectRequest
{
    #[NotBlank]
    private string $name;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
