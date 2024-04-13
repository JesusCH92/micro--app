<?php

declare(strict_types=1);

namespace App\Driver\Domain\ValueObject;

use App\Common\Domain\ValueObject\StringValueObject;
use App\Driver\Domain\Exception\InvalidLicense;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class License extends StringValueObject
{
    const LENGTH_MAX = 1;

    #[ORM\Column(name: 'license', type: Types::STRING, length: 1, nullable: false)]
    protected ?string $value;

    protected function saveIfIsAllowed(?string $value): void
    {
        if (in_array($value, ['', null], true)) {
            throw new InvalidLicense('License is required');
        }

        if (strlen($value) > self::LENGTH_MAX) {
            throw new InvalidLicense(sprintf('%s is greater than %s characters', $value, self::LENGTH_MAX));
        }
    }
}
