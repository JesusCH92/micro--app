<?php

declare(strict_types=1);

namespace App\Driver\ApplicationService\DTO;

readonly class DriversSearcherRequest
{
    public function __construct(public ?string $date, public ?int $vehicleId)
    {
    }
}