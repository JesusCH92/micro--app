<?php

namespace App\Tests\Trip\Creator;

use App\Driver\ApplicationService\DTO\DriversSearcherRequest;
use App\Driver\Domain\Entity\Driver;
use App\Driver\Domain\Entity\Drivers;
use App\Driver\Domain\Repository\DriverRepository;

class StubDriverRepository implements DriverRepository
{
    const DRIVER_NAME = 'TEST';
    const DRIVER_SURNAME = 'CREATOR';
    const DRIVER_LICENSE = 'Z';

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
        return new Driver(self::DRIVER_NAME, self::DRIVER_SURNAME, self::DRIVER_LICENSE);
    }

    public function search(DriversSearcherRequest $dto): Drivers
    {
        return new Drivers([]);
    }
}