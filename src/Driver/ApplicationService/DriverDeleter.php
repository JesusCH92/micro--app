<?php

declare(strict_types=1);

namespace App\Driver\ApplicationService;

use App\Driver\Domain\Entity\Driver;
use App\Driver\Domain\Exception\NotFoundDriver;
use App\Driver\Domain\Repository\DriverRepository;

final class DriverDeleter
{
    public function __construct(private readonly DriverRepository $repository)
    {
    }

    public function __invoke(int $driverId): void
    {
        $driver = $this->findDriverOrFail($driverId);

        $this->repository->delete($driver);
    }

    private function findDriverOrFail(int $driverId): Driver
    {
        $driver = $this->repository->findById($driverId);

        if (null === $driver) {
            throw new NotFoundDriver(sprintf('Not found driver with id: <%s>', $driverId));
        }

        return $driver;
    }
}