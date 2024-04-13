<?php

declare(strict_types=1);

namespace App\Vehicle\Domain\ValueObject;

use App\Common\Domain\ValueObject\StringValueObject;
use App\Vehicle\Domain\Exception\InvalidBrand;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class Brand extends StringValueObject
{
    const LENGTH_MAX = 30;

    #[ORM\Column(name: 'brand', type: Types::STRING, length: 30, nullable: false)]
    protected ?string $value;

    protected function saveIfIsAllowed(?string $value): void
    {
        if (in_array($value, ['', null], true)) {
            throw new InvalidBrand('Brand is required');
        }

        if (strlen($value) > self::LENGTH_MAX) {
            throw new InvalidBrand(sprintf('%s is greater than %s characters', $value, self::LENGTH_MAX));
        }
    }
}