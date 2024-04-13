<?php

namespace App\Vehicle\Domain\ValueObject;

use App\Common\Domain\ValueObject\StringValueObject;
use App\Vehicle\Domain\Exception\InvalidPlate;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class Plate extends StringValueObject
{
    const LENGTH_MAX = 40;

    #[ORM\Column(name: 'plate', type: Types::STRING, length: 40, nullable: false)]
    protected ?string $value;

    protected function saveIfIsAllowed(?string $value): void
    {
        if (in_array($value, ['', null], true)) {
            throw new InvalidPlate('Plate is required');
        }

        if (strlen($value) > self::LENGTH_MAX) {
            throw new InvalidPlate(sprintf('%s is greater than %s characters', $value, self::LENGTH_MAX));
        }
    }
}