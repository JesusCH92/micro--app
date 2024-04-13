<?php

namespace App\Driver\Domain\ValueObject;

use App\Common\Domain\ValueObject\StringValueObject;
use App\Driver\Domain\Exception\InvalidName;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class Name extends StringValueObject
{
    const LENGTH_MAX = 200;

    #[ORM\Column(name: 'name', type: Types::STRING, length: 200, nullable: false)]
    protected ?string $value;

    protected function saveIfIsAllowed(?string $value): void
    {
        if (in_array($value, ['', null], true)) {
            throw new InvalidName('Name is required');
        }

        if (strlen($value) > self::LENGTH_MAX) {
            throw new InvalidName(sprintf('%s is greater than %s characters', $value, self::LENGTH_MAX));
        }
    }
}
