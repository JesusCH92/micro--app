<?php

declare(strict_types=1);

namespace App\Driver\ApplicationService\DTO;

readonly class DriverCreatorRequest
{
    public function __construct(public ?string $name, public ?string $surname, public ?string $license)
    {
    }
}