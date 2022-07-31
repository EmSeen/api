<?php

namespace App\Exception;

use JetBrains\PhpStorm\Pure;
use RuntimeException;
use Throwable;

class RequestBodyConvertException extends RuntimeException
{
    #[Pure] public function __construct(Throwable $previous)
    {
        parent::__construct('Error while unmarshalling request body', 0, $previous);
    }
}
