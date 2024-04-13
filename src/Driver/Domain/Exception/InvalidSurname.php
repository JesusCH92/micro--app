<?php

namespace App\Driver\Domain\Exception;

use Exception;
use Throwable;

final class InvalidSurname extends Exception
{
    public function __construct(string $message, int $code = 400, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
