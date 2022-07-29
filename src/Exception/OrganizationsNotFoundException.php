<?php

namespace App\Exception;

use JetBrains\PhpStorm\Pure;
use RuntimeException;

class OrganizationsNotFoundException extends RuntimeException
{
    #[Pure]
    public function __construct()
    {
        parent::__construct('Такой записи не существует');
    }
}
