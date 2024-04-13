<?php

declare(strict_types=1);

namespace App\Vehicle\Domain\ValueObject;

use App\Common\Domain\ValueObject\StringValueObject;
use App\Vehicle\Domain\Exception\InvalidLicenseRequired;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class LicenseRequired extends StringValueObject
{
    const LENGTH_MAX = 1;

    #[ORM\Column(name: 'license_required', type: Types::STRING, length: 1, nullable: false)]
    protected ?string $value;

    protected function saveIfIsAllowed(?string $value): void
    {
        if (in_array($value, ['', null], true)) {
            throw new InvalidLicenseRequired('License is required');
        }

        if (strlen($value) > self::LENGTH_MAX) {
            throw new InvalidLicenseRequired(sprintf('%s is greater than %s characters', $value, self::LENGTH_MAX));
        }
    }
}