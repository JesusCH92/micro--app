<?php

namespace App\Driver\Domain\ValueObject;

use App\Common\Domain\ValueObject\StringValueObject;
use App\Driver\Domain\Exception\InvalidSurname;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class Surname extends StringValueObject
{
    const LENGTH_MAX = 200;

    #[ORM\Column(name: 'surname', type: Types::STRING, length: 200, nullable: false)]
    protected ?string $value;

    protected function saveIfIsAllowed(?string $value): void
    {
        if (in_array($value, ['', null], true)) {
            throw new InvalidSurname('Surname is required');
        }

        if (strlen($value) > self::LENGTH_MAX) {
            throw new InvalidSurname(sprintf('%s is greater than %s characters', $value, self::LENGTH_MAX));
        }
    }
}
