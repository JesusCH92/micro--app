<?php

namespace App\Tests\Driver\Deleter;

use App\Driver\ApplicationService\DriverDeleter;
use App\Driver\Domain\Entity\Driver;
use App\Driver\Domain\Exception\DriverIsNotDeletable;
use App\Driver\Domain\Exception\NotFoundDriver;
use App\Driver\Domain\Repository\DriverRepository;
use PHPUnit\Framework\TestCase;

class DriverDeleterTest extends TestCase
{
    /**
     * @test
     * @dataProvider driverDeleterRequest
     */
    public function shouldDeleteDriver(int $driverId)
    {
        $spy = new SpyDriverRepository();

        $service = new DriverDeleter($spy);

        $service($driverId);

        $this->assertTrue($spy->verify());
    }

    /**
     * @test
     * @dataProvider driverDeleterRequest
     */
    public function shouldThrowNotFoundDriverException(int $driverId)
    {
        $this->expectException(NotFoundDriver::class);

        $service = new DriverDeleter(new StubDriverRepository());

        $service($driverId);
    }

    public function driverDeleterRequest(): array
    {
        return [
            [123456789],
            [987654321],
            [456789123],
            [789123456],
            [321654987],
            [654987321],
            [135792468],
            [246813579],
            [369258147],
            [741852963],
            [852963741],
            [963258147],
            [147258369],
            [258369147],
            [369147258],
            [471529348],
            [582631479],
            [693742815],
            [714856932],
            [825974136]
        ];
    }
}