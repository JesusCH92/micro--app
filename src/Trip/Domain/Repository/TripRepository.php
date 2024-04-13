<?php

declare(strict_types=1);

namespace App\Trip\Domain\Repository;

use App\Trip\Domain\Entity\Trip;
use App\Trip\Domain\Entity\Trips;

interface TripRepository
{
    public function all(): Trips;

    public function save(Trip $trip): void;
}