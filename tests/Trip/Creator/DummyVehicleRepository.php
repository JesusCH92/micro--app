<?php

namespace App\Tests\Trip\Creator;

use App\Vehicle\ApplicationService\DTO\VehiclesSearcherRequest;
use App\Vehicle\Domain\Entity\Vehicle;
use App\Vehicle\Domain\Entity\Vehicles;
use App\Vehicle\Domain\Repository\VehicleRepository;

class DummyVehicleRepository implements VehicleRepository
{
    public function all(): Vehicles
    {
        return new Vehicles([]);
    }

    public function save(Vehicle $vehicle): void
    {
    }

    public function delete(Vehicle $vehicle): void
    {
    }

    public function findById(?int $vehicleId): ?Vehicle
    {
        return null;
    }

    public function search(VehiclesSearcherRequest $dto): Vehicles
    {
        return new Vehicles([]);
    }
}