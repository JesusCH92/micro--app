<?php

declare(strict_types=1);

namespace App\Vehicle\Domain\Exception;

use Exception;
use Throwable;

final class NotFoundVehicle extends Exception
{
    public function __construct(string $message, int $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}