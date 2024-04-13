<?php

declare(strict_types=1);

namespace App\Trip\ApplicationService;

use App\Trip\Domain\Entity\Trips;
use App\Trip\Domain\Repository\TripRepository;

final class TripGetter
{
    public function __construct(private readonly TripRepository $repository)
    {
    }

    public function __invoke(): Trips
    {
        return $this->repository->all();
    }
}