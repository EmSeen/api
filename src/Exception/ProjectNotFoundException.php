<?php

namespace App\Exception;

use JetBrains\PhpStorm\Pure;
use RuntimeException;

class ProjectNotFoundException extends RuntimeException
{
    #[Pure]
    public function __construct()
    {
        parent::__construct('Такого проекта не существует');
    }
}
