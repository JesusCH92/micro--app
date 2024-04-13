<?php

declare(strict_types=1);

namespace App\Vehicle\Infrastructure\Persistence;

use App\Common\Infrastructure\Persistence\DoctrineRepository;
use App\Trip\Domain\Entity\Trip;
use App\Vehicle\ApplicationService\DTO\VehiclesSearcherRequest;
use App\Vehicle\Domain\Entity\Vehicle;
use App\Vehicle\Domain\Entity\Vehicles;
use App\Vehicle\Domain\Repository\VehicleRepository;

final class DoctrineVehicleRepository extends DoctrineRepository implements VehicleRepository
{
    public function all(): Vehicles
    {
        $collection = $this->repository(Vehicle::class)->findAll();
        
        return new Vehicles($collection);
    }

    public function save(Vehicle $vehicle): void
    {
        $this->entityManager()->persist($vehicle);
        $this->entityManager()->flush();
    }

    public function delete(Vehicle $vehicle): void
    {
        $this->entityManager()->remove($vehicle);
        $this->entityManager()->flush();
    }

    public function findById(?int $vehicleId): ?Vehicle
    {
        return $this->repository(Vehicle::class)->findOneBy(['id' => $vehicleId]);
    }

    public function search(VehiclesSearcherRequest $dto): Vehicles
    {
        $qb = $this->ormQueryBuilder()
            ->select('v')
            ->from(Vehicle::class, 'v')
            ->leftJoin(
                Trip::class,
                't',
                'WITH',
                't.vehicle = v.id AND t.date = :date')
            ->andWhere('t.id IS NULL')
            ->setParameter('date', $dto->date);

        $collection = $qb->getQuery()->getResult();

        return new Vehicles($collection);
    }
}