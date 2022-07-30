<?php

namespace App\Exception;

use JetBrains\PhpStorm\Pure;
use RuntimeException;

class OrganizationNotFoundException extends RuntimeException
{
    #[Pure]
    public function __construct()
    {
        parent::__construct('Такой организации не существует');
    }
}
