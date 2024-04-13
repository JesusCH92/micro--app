<?php

declare(strict_types=1);

namespace App\Driver\Infrastructure\Persistence;

use App\Common\Infrastructure\Persistence\DoctrineRepository;
use App\Driver\ApplicationService\DTO\DriversSearcherRequest;
use App\Driver\Domain\Entity\Driver;
use App\Driver\Domain\Entity\Drivers;
use App\Driver\Domain\Repository\DriverRepository;
use App\Trip\Domain\Entity\Trip;
use App\Vehicle\Domain\Entity\Vehicle;

final class DoctrineDriverRepository extends DoctrineRepository implements DriverRepository
{

    public function all(): Drivers
    {
        $collection = $this->repository(Driver::class)->findAll();

        return new Drivers($collection);
    }

    public function save(Driver $driver): void
    {
        $this->entityManager()->persist($driver);
        $this->entityManager()->flush();
    }

    public function delete(Driver $driver): void
    {
        $this->entityManager()->remove($driver);
        $this->entityManager()->flush();
    }

    public function findById(?int $driverId): ?Driver
    {
        return $this->repository(Driver::class)->findOneBy(['id' => $driverId]);
    }

    public function search(DriversSearcherRequest $dto): Drivers
    {
        $qb = $this->ormQueryBuilder()
            ->select('d')
            ->from(Driver::class, 'd')
            ->leftJoin(
                Trip::class,
                't',
                'WITH',
                't.driver = d.id AND t.date = :date'
            )
            ->innerJoin(
                Vehicle::class,
                'v',
                'WITH',
                'v.id = :vehicleId AND d.license.value = v.licenseRequired.value'
            )
            ->andWhere('t.id IS NULL')
            ->setParameter('vehicleId', $dto->vehicleId)
            ->setParameter('date', $dto->date);

        $collection = $qb->getQuery()->getResult();

        return new Drivers($collection);
    }
}