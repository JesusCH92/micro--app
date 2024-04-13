<?php

namespace App\Tests\Trip\Creator;

use App\Tests\Common\Spy;
use App\Trip\Domain\Entity\Trip;
use App\Trip\Domain\Entity\Trips;
use App\Trip\Domain\Repository\TripRepository;

class SpyTripRepository extends Spy implements TripRepository
{
    public function all(): Trips
    {
        return new Trips([]);
    }

    public function save(Trip $trip): void
    {
        $this->validateWasCalled = true;
    }
}