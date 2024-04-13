<?php

namespace App\Vehicle\Domain\Entity;

use App\Common\Domain\Collection;

final class Vehicles extends Collection
{
    protected function type(): string
    {
        return Vehicle::class;
    }

    public function mappingSelect2(): array
    {
        return array_map(fn(Vehicle $vehicle) => ['id' => $vehicle->id(), 'text' => $vehicle->description()], $this->items());
    }
}
