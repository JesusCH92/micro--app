<?php

declare(strict_types=1);

namespace App\Driver\Domain\Repository;

use App\Driver\ApplicationService\DTO\DriversSearcherRequest;
use App\Driver\Domain\Entity\Driver;
use App\Driver\Domain\Entity\Drivers;

interface DriverRepository
{
    public function all(): Drivers;

    public function save(Driver $driver): void;

    public function delete(Driver $driver): void;

    public function findById(?int $driverId): ?Driver;

    public function search(DriversSearcherRequest $dto): Drivers;
}