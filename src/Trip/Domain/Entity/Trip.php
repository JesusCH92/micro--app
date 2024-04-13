<?php

namespace App\Trip\Domain\Entity;

use App\Driver\Domain\Entity\Driver;
use App\Vehicle\Domain\Entity\Vehicle;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'trip')]
class Trip
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Vehicle::class)]
    #[ORM\JoinColumn(name: 'vehicle_id', nullable: false)]
    private Vehicle $vehicle;

    #[ORM\ManyToOne(targetEntity: Driver::class)]
    #[ORM\JoinColumn(name: 'driver_id', nullable: false)]
    private Driver $driver;

    #[ORM\Column(name: 'date', type: Types::DATE_IMMUTABLE, nullable: false)]
    private DateTimeImmutable $date;

    public function __construct(Vehicle $vehicle, Driver $driver, DateTimeImmutable $date)
    {
        $this->vehicle = $vehicle;
        $this->driver = $driver;
        $this->date = $date;
    }

    public function id(): ?int
    {
        return $this->id;
    }

    public function vehicle(): Vehicle
    {
        return $this->vehicle;
    }

    public function driver(): Driver
    {
        return $this->driver;
    }

    public function date(): DateTimeImmutable
    {
        return $this->date;
    }

    public function __serialize(): array
    {
        return [
            'id' => $this->id(),
            'vehicle' => $this->vehicle()->description(),
            'driver' => $this->driver()->description(),
            'date' => $this->date()->format('m/d/Y')
        ];
    }
}
