<?php

declare(strict_types=1);

namespace App\Driver\Domain\Entity;

use App\Common\Domain\Collection;

final class Drivers extends Collection
{
    protected function type(): string
    {
        return Driver::class;
    }

    public function mappingSelect2(): array
    {
        return array_map(fn(Driver $driver) => ['id' => $driver->id(), 'text' => $driver->description()],
            $this->items());
    }
}