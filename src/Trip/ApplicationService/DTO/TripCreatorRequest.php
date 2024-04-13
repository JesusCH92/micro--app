<?php

declare(strict_types=1);

namespace App\Trip\ApplicationService\DTO;

use DateTimeImmutable;

final class TripCreatorRequest
{
    private ?DateTimeImmutable $date;
    private ?int $vehicle;
    private ?int $driver;

    public function getDate(): ?DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(?DateTimeImmutable $date): void
    {
        $this->date = $date;
    }

    public function getVehicle(): ?int
    {
        return $this->vehicle;
    }

    public function setVehicle(?int $vehicle): void
    {
        $this->vehicle = $vehicle;
    }

    public function getDriver(): ?int
    {
        return $this->driver;
    }

    public function setDriver(?int $driver): void
    {
        $this->driver = $driver;
    }
}
