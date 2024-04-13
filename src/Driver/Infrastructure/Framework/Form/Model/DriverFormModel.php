<?php

namespace App\Driver\Infrastructure\Framework\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

class DriverFormModel
{
    #[Assert\NotBlank]
    private $name;
    #[Assert\NotBlank]
    private $surname;
    #[Assert\NotBlank]
    private $license;

    public function getName()
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function setSurname(?string $surname): void
    {
        $this->surname = $surname;
    }

    public function getLicense()
    {
        return $this->license;
    }

    public function setLicense(?string $license): void
    {
        $this->license = $license;
    }
}