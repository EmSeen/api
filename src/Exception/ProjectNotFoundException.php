<?php

namespace App\Exception;

use JetBrains\PhpStorm\Pure;
use RuntimeException;
use Symfony\Component\HttpFoundation\Response;

class ProjectNotFoundException extends RuntimeException
{
    #[Pure]
    public function __construct()
    {
        parent::__construct('проект на найден c таким id', Response::HTTP_NOT_FOUND);
    }
}
