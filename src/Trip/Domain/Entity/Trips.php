<?php

declare(strict_types=1);

namespace App\Trip\Domain\Entity;

use App\Common\Domain\Collection;

final class Trips extends Collection
{
    protected function type(): string
    {
        return Trip::class;
    }
}
