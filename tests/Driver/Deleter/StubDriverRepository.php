<?php

namespace App\Tests\Driver\Deleter;

use App\Driver\ApplicationService\DTO\DriversSearcherRequest;
use App\Driver\Domain\Entity\Driver;
use App\Driver\Domain\Entity\Drivers;
use App\Driver\Domain\Repository\DriverRepository;

class StubDriverRepository implements DriverRepository
{
    public function all(): Drivers
    {
        return new Drivers([]);
    }

    public function save(Driver $driver): void
    {
    }

    public function delete(Driver $driver): void
    {
    }

    public function findById(?int $driverId): ?Driver
    {
        return null;
    }

    public function search(DriversSearcherRequest $dto): Drivers
    {
        return new Drivers([]);
    }
}