<?php

declare(strict_types=1);

namespace App\Vehicle\ApplicationService;

use App\Vehicle\Domain\Entity\Vehicle;
use App\Vehicle\Domain\Exception\NotFoundVehicle;
use App\Vehicle\Domain\Exception\VehicleIsNotDeletable;
use App\Vehicle\Domain\Repository\VehicleRepository;

final class VehicleDeleter
{
    public function __construct(private readonly VehicleRepository $repository)
    {
    }

    public function __invoke(int $vehicleId): void
    {
        $vehicle = $this->findVehicleOrFail($vehicleId);

        $this->failIfIsNotDeletable($vehicle);

        $this->repository->delete($vehicle);
    }

    private function findVehicleOrFail(int $vehicleId): Vehicle
    {
        $vehicle = $this->repository->findById($vehicleId);

        if (null === $vehicle) {
            throw new NotFoundVehicle(sprintf('Not found vehicle with id: <%s>', $vehicleId));
        }

        return $vehicle;
    }
    private function failIfIsNotDeletable(Vehicle $vehicle): void
    {
        if (!$vehicle->isDeletable()) {
            throw new VehicleIsNotDeletable('Vehicle has trips and cannot be removed');
        }
    }
}
