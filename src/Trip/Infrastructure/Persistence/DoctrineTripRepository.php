<?php

declare(strict_types=1);

namespace App\Trip\Infrastructure\Persistence;

use App\Common\Infrastructure\Persistence\DoctrineRepository;
use App\Trip\Domain\Entity\Trip;
use App\Trip\Domain\Entity\Trips;
use App\Trip\Domain\Repository\TripRepository;

final class DoctrineTripRepository extends DoctrineRepository implements TripRepository
{
    public function all(): Trips
    {
        $collection = $this->repository(Trip::class)->findAll();

        return new Trips($collection);
    }

    public function save(Trip $trip): void
    {
        $this->entityManager()->persist($trip);
        $this->entityManager()->flush();
    }
}