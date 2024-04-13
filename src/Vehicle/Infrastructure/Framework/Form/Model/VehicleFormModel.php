<?php

namespace App\Vehicle\Infrastructure\Framework\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

class VehicleFormModel
{
    #[Assert\NotBlank]
    private $brand;
    #[Assert\NotBlank]
    private $model;
    #[Assert\NotBlank]
    private $plate;
    #[Assert\NotBlank]
    private $licenseRequired;
    
    public function brand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(?string $brand): void
    {
        $this->brand = $brand;
    }

    public function model(): ?string
    {
        return $this->model;
    }

    public function setModel(?string $model): void
    {
        $this->model = $model;
    }

    public function plate(): ?string
    {
        return $this->plate;
    }

    public function setPlate(?string $plate): void
    {
        $this->plate = $plate;
    }

    public function licenseRequired(): ?string
    {
        return $this->licenseRequired;
    }

    public function setLicenseRequired(?string $licenseRequired): void
    {
        $this->licenseRequired = $licenseRequired;
    }
}