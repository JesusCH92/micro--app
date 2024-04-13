<?php

declare(strict_types=1);

namespace App\Vehicle\ApplicationService\DTO;

readonly class VehicleCreatorRequest
{
    public function __construct(
        public ?string $brand,
        public ?string $model,
        public ?string $plate,
        public ?string $licenseRequired
    ) {
    }
}