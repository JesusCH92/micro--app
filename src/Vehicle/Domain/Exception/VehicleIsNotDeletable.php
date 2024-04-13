<?php

namespace App\Vehicle\Domain\Exception;

use Exception;
use Throwable;

final class VehicleIsNotDeletable extends Exception
{
    public function __construct(string $message, int $code = 400, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
