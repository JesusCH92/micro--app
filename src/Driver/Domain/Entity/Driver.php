<?php

namespace App\Driver\Domain\Entity;

use App\Driver\Domain\ValueObject\License;
use App\Driver\Domain\ValueObject\Name;
use App\Driver\Domain\ValueObject\Surname;
use App\Trip\Domain\Entity\Trip;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'driver')]
class Driver
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Embedded(class: Name::class, columnPrefix: false)]
    private Name $name;

    #[ORM\Embedded(class: Surname::class, columnPrefix: false)]
    private Surname $surname;

    #[ORM\Embedded(class: License::class, columnPrefix: false)]
    private License $license;

    #[ORM\OneToMany(targetEntity: Trip::class, mappedBy: 'driver')]
    private Collection $trips;

    public function __construct(?string $name, ?string $surname, ?string $license)
    {
        $this->name    = new Name($name);
        $this->surname = new Surname($surname);
        $this->license = new License($license);
        $this->trips = new ArrayCollection();
    }

    public function id(): ?int
    {
        return $this->id;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function surname(): Surname
    {
        return $this->surname;
    }

    public function license(): License
    {
        return $this->license;
    }

    public function description(): string
    {
        return (string)$this->name() . ' - ' . (string)$this->surname() . ' - ' . $this->license();
    }

    public function trips(): Collection
    {
        return $this->trips;
    }

    public function tripCollection(): array
    {
        $collection = [];

        foreach ($this->trips() as $trip) {
            $collection[] = $trip;
        }

        return $collection;
    }

    public function isDeletable(): bool
    {
        return $this->tripCollection() === [];
    }
}
