<?php

declare(strict_types=1);

namespace App\Vehicle\Domain\Repository;

use App\Vehicle\ApplicationService\DTO\VehiclesSearcherRequest;
use App\Vehicle\Domain\Entity\Vehicle;
use App\Vehicle\Domain\Entity\Vehicles;

interface VehicleRepository
{
    public function all(): Vehicles;

    public function save(Vehicle $vehicle): void;

    public function delete(Vehicle $vehicle): void;

    public function findById(?int $vehicleId): ?Vehicle;

    public function search(VehiclesSearcherRequest $dto): Vehicles;
}