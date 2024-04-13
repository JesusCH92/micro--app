<?php

declare(strict_types=1);

namespace App\Vehicle\ApplicationService;

use App\Vehicle\Domain\Entity\Vehicles;
use App\Vehicle\Domain\Repository\VehicleRepository;

final class VehicleGetter
{
    public function __construct(private readonly VehicleRepository $repository)
    {
    }

    public function __invoke(): Vehicles
    {
        return $this->repository->all();
    }
}