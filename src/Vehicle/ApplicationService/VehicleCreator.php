<?php

declare(strict_types=1);

namespace App\Vehicle\ApplicationService;

use App\Vehicle\ApplicationService\DTO\VehicleCreatorRequest;
use App\Vehicle\Domain\Repository\VehicleRepository;
use App\Vehicle\Domain\Entity\Vehicle;

final class VehicleCreator
{
    public function __construct(private readonly VehicleRepository $repository)
    {
    }

    public function __invoke(VehicleCreatorRequest $request)
    {
        $vehicle = new Vehicle(
            $request->brand,
            $request->model,
            $request->plate,
            $request->licenseRequired
        );

        $this->repository->save($vehicle);
    }
}
