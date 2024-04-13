<?php

declare(strict_types=1);

namespace App\Vehicle\ApplicationService\DTO;

readonly class VehiclesSearcherRequest
{
    public function __construct(public ?string $date)
    {
    }
}