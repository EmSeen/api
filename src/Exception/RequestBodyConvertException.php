<?php

namespace App\Exception;

use JetBrains\PhpStorm\Pure;
use RuntimeException;
use Throwable;

class RequestBodyConvertException extends RuntimeException
{
    #[Pure] public function __construct(Throwable $previous)
    {
        parent::__construct('Ошибка при распаковке тела запроса', 0, $previous);
    }
}
