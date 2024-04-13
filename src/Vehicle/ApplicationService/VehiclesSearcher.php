<?php

declare(strict_types=1);

namespace App\Vehicle\ApplicationService;

use App\Vehicle\ApplicationService\DTO\VehiclesSearcherRequest;
use App\Vehicle\Domain\Repository\VehicleRepository;

final class VehiclesSearcher
{
    public function __construct(private readonly VehicleRepository $repository)
    {
    }

    public function __invoke(VehiclesSearcherRequest $request)
    {
        return $this->repository->search($request);
    }
}