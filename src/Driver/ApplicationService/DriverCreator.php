<?php

declare(strict_types=1);

namespace App\Driver\ApplicationService;

use App\Driver\ApplicationService\DTO\DriverCreatorRequest;
use App\Driver\Domain\Entity\Driver;
use App\Driver\Domain\Repository\DriverRepository;

final class DriverCreator
{
    public function __construct(private readonly DriverRepository $repository)
    {
    }

    public function __invoke(DriverCreatorRequest $request): Driver
    {
        $driver = new Driver($request->name, $request->surname, $request->license);

        $this->repository->save($driver);

        return $driver;
    }
}