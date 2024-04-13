<?php

declare(strict_types=1);

namespace App\Driver\ApplicationService;

use App\Driver\ApplicationService\DTO\DriversSearcherRequest;
use App\Driver\Domain\Entity\Drivers;
use App\Driver\Domain\Repository\DriverRepository;

final class DriversSearcher
{
    public function __construct(private readonly DriverRepository $repository)
    {
    }

    public function __invoke(DriversSearcherRequest $request): Drivers
    {
        return $this->repository->search($request);
    }
}