<?php

declare(strict_types=1);

namespace App\Driver\ApplicationService;

use App\Driver\Domain\Entity\Drivers;
use App\Driver\Domain\Repository\DriverRepository;

final class DriverGetter
{
    public function __construct(private readonly DriverRepository $repository)
    {
    }

    public function __invoke(): Drivers
    {
        return $this->repository->all();
    }
}
