<?php

declare(strict_types=1);

namespace App\Trip\ApplicationService;

use App\Driver\Domain\Entity\Driver;
use App\Driver\Domain\Exception\NotFoundDriver;
use App\Driver\Domain\Repository\DriverRepository;
use App\Trip\ApplicationService\DTO\TripCreatorRequest;
use App\Trip\Domain\Entity\Trip;
use App\Trip\Domain\Repository\TripRepository;
use App\Vehicle\Domain\Entity\Vehicle;
use App\Vehicle\Domain\Exception\NotFoundVehicle;
use App\Vehicle\Domain\Repository\VehicleRepository;
use DateTimeImmutable;

final class TripCreator
{
    public function __construct(
        private readonly TripRepository $repository,
        private readonly VehicleRepository $vehicleRepository,
        private readonly DriverRepository $driverRepository
    ) {
    }

    public function __invoke(TripCreatorRequest $request): Trip
    {
        $vehicle = $this->findVehicleOrFail($request->getVehicle());
        $driver = $this->findDriverOrFail($request->getDriver());
        $date = $this->failIfIsNull($request->getDate());

        //TODO: falta implementar la logica de negocio que VALIDA que trip pueda ser creado

        $trip = new Trip($vehicle, $driver, $date);

        $this->repository->save($trip);

        return $trip;
    }

    private function findVehicleOrFail(?int $vehicleId): Vehicle
    {
        $vehicle = $this->vehicleRepository->findById($vehicleId);

        if (null === $vehicle) {
            throw new NotFoundVehicle(sprintf('Not found vehicle with id: <%s>', $vehicleId));
        }

        return $vehicle;
    }

    private function findDriverOrFail(?int $driverId): Driver
    {
        $driver = $this->driverRepository->findById($driverId);

        if (null === $driver) {
            throw new NotFoundDriver(sprintf('Not found driver with id: <%s>', $driverId));
        }

        return $driver;
    }

    private function failIfIsNull(?DateTimeImmutable $date): DateTimeImmutable
    {
        if (null === $date) {
            throw new \InvalidArgumentException('Must give me a date');
        }

        return $date;
    }
}