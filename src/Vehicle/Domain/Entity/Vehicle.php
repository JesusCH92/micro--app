<?php

namespace App\Vehicle\Domain\Entity;

use App\Vehicle\Domain\ValueObject\Brand;
use App\Vehicle\Domain\ValueObject\LicenseRequired;
use App\Vehicle\Domain\ValueObject\Model;
use App\Vehicle\Domain\ValueObject\Plate;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'vehicle')]
class Vehicle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Embedded(class: Brand::class, columnPrefix: false)]
    private Brand $brand;

    #[ORM\Embedded(class: Model::class, columnPrefix: false)]
    private Model $model;

    #[ORM\Embedded(class: Plate::class, columnPrefix: false)]
    private Plate $plate;

    #[ORM\Embedded(class: LicenseRequired::class, columnPrefix: false)]
    private LicenseRequired $licenseRequired;

    public function __construct(?string $brand, ?string $model, ?string $plate, ?string $licenseRequired)
    {
        $this->brand           = new Brand($brand);
        $this->model           = new Model($model);
        $this->plate           = new Plate($plate);
        $this->licenseRequired = new LicenseRequired($licenseRequired);
    }

    public function id(): ?int
    {
        return $this->id;
    }

    public function brand(): Brand
    {
        return $this->brand;
    }

    public function model(): Model
    {
        return $this->model;
    }

    public function plate(): Plate
    {
        return $this->plate;
    }

    public function licenseRequired(): LicenseRequired
    {
        return $this->licenseRequired;
    }

    public function description(): string
    {
        return (string)$this->brand() . ' - ' . (string)$this->model() . ' - ' . (string)$this->plate();
    }
}
