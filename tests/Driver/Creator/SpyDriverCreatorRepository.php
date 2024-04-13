<?php

namespace App\Tests\Driver\Creator;

use App\Driver\ApplicationService\DTO\DriversSearcherRequest;
use App\Driver\Domain\Entity\Driver;
use App\Driver\Domain\Entity\Drivers;
use App\Driver\Domain\Repository\DriverRepository;
use App\Tests\Common\Spy;

class SpyDriverCreatorRepository extends Spy implements DriverRepository
{

    public function all(): Drivers
    {
        return new Drivers([]);
    }

    public function save(Driver $driver): void
    {
        $this->validateWasCalled = true;
    }

    public function delete(Driver $driver): void
    {
    }

    public function findById(?int $driverId): ?Driver
    {
        return new Driver(name: 'Driver',surname: 'Test', license: 'A');
    }

    public function search(DriversSearcherRequest $dto): Drivers
    {
        return new Drivers([]);
    }
}