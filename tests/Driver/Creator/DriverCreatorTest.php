<?php

namespace App\Tests\Driver\Creator;

use App\Driver\ApplicationService\DriverCreator;
use App\Driver\ApplicationService\DTO\DriverCreatorRequest;
use PHPUnit\Framework\TestCase;

class DriverCreatorTest extends TestCase
{
    /**
     * @test
     * @dataProvider driverCreatorRequest
     */
    public function shouldCreateDriver(string $name, string $surname, string $license)
    {
        $service = new DriverCreator(new DummyDriverRepository());

        $driver = $service(new DriverCreatorRequest($name, $surname, $license));

        $this->assertEquals($name, $driver->name()->value());
        $this->assertEquals($surname, $driver->surname()->value());
        $this->assertEquals($license, $driver->license()->value());
    }

    /**
     * @test
     * @dataProvider driverCreatorRequest
     */
    public function shouldCreateDriverWithSave(string $name, string $surname, string $license)
    {
        $spy = new SpyDriverCreatorRepository();

        $service = new DriverCreator($spy);

        $driver = $service(new DriverCreatorRequest($name, $surname, $license));

        $this->assertTrue($spy->verify());

        $this->assertEquals($name, $driver->name()->value());
        $this->assertEquals($surname, $driver->surname()->value());
        $this->assertEquals($license, $driver->license()->value());
    }

    private function driverCreatorRequest(): array
    {
        return [
            ['John', 'Smith', 'A'],
            ['Jane', 'Johnson', 'B'],
            ['Alice', 'Williams', 'G'],
            ['Bob', 'Brown', 'M'],
            ['Mary', 'Jones', 'N'],
            ['Michael', 'Davis', 'Q'],
            ['Jessica', 'Miller', 'W'],
            ['David', 'Wilson', 'X'],
            ['Sarah', 'Taylor', '1'],
            ['James', 'Anderson', '4'],
            ['Emily', 'Thomas', 'A'],
            ['Daniel', 'Clark', 'D'],
            ['Olivia', 'Hill', 'G'],
            ['Matthew', 'Moore', 'J'],
            ['Emma', 'Lewis', 'M'],
            ['Liam', 'Walker', 'S'],
            ['Noah', 'White', 'T'],
            ['Sophia', 'Martin', 'V'],
            ['Oliver', 'Lee', '1'],
            ['Ava', 'Allen', 'W'],
        ];
    }
}
