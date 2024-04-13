<?php

namespace App\Tests\Trip\Creator;

use App\Driver\Domain\Exception\NotFoundDriver;
use App\Trip\ApplicationService\DTO\TripCreatorRequest;
use App\Trip\ApplicationService\TripCreator;
use App\Vehicle\Domain\Exception\NotFoundVehicle;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class TripCreatorTest extends TestCase
{
    /**
     * @test
     * @dataProvider tripCreatorProvider
     */
    public function shouldCreateTrip(DateTimeImmutable $date, int $vehicle, int $driver)
    {
        $service = new TripCreator(new DummyTripRepository(), new StubVehicleRepository(), new StubDriverRepository());

        $request = new TripCreatorRequest();
        $request->setDriver($driver);
        $request->setVehicle($vehicle);
        $request->setDate($date);

        $trip = $service($request);

        $this->assertEquals($date->format('m-d-Y'), $trip->date()->format('m-d-Y'));
        $this->assertEquals(StubDriverRepository::DRIVER_NAME, $trip->driver()->name()->value());
        $this->assertEquals(StubDriverRepository::DRIVER_SURNAME, $trip->driver()->surname()->value());
        $this->assertEquals(StubDriverRepository::DRIVER_LICENSE, $trip->driver()->license()->value());
        $this->assertEquals(StubVehicleRepository::BRAND, $trip->vehicle()->brand()->value());
        $this->assertEquals(StubVehicleRepository::MODEL, $trip->vehicle()->model()->value());
        $this->assertEquals(StubVehicleRepository::PLATE, $trip->vehicle()->plate()->value());
        $this->assertEquals(StubVehicleRepository::LICENSE, $trip->vehicle()->licenseRequired()->value());
    }

    /**
     * @test
     * @dataProvider tripCreatorProvider
     */
    public function shouldCreateTripCallingSave(DateTimeImmutable $date, int $vehicle, int $driver)
    {
        $spy = new SpyTripRepository();

        $service = new TripCreator($spy, new StubVehicleRepository(), new StubDriverRepository());

        $request = new TripCreatorRequest();
        $request->setDriver($driver);
        $request->setVehicle($vehicle);
        $request->setDate($date);

        $service($request);

        $this->assertTrue($spy->verify());
    }

    /**
     * @test
     * @dataProvider tripCreatorProvider
     */
    public function throwNotFoundDriver(DateTimeImmutable $date, int $vehicle, int $driver)
    {
        $this->expectException(NotFoundDriver::class);

        $service = new TripCreator(new DummyTripRepository(), new StubVehicleRepository(), new DummyDriverRepository());

        $request = new TripCreatorRequest();
        $request->setDriver($driver);
        $request->setVehicle($vehicle);
        $request->setDate($date);

        $service($request);
    }

    /**
     * @test
     * @dataProvider tripCreatorProvider
     */
    public function throwNotFoundVehicle(DateTimeImmutable $date, int $vehicle, int $driver)
    {
        $this->expectException(NotFoundVehicle::class);

        $service = new TripCreator(new DummyTripRepository(), new DummyVehicleRepository(), new StubDriverRepository());

        $request = new TripCreatorRequest();
        $request->setDriver($driver);
        $request->setVehicle($vehicle);
        $request->setDate($date);

        $service($request);
    }

    public function tripCreatorProvider(): array
    {
        return  [
            [new DateTimeImmutable('2024-04-15'), 12345, 54321],
            [new DateTimeImmutable('2024-04-16'), 67890, 98765],
            [new DateTimeImmutable('2024-04-17'), 24680, 13579],
            [new DateTimeImmutable('2024-04-18'), 97531, 35792],
            [new DateTimeImmutable('2024-04-19'), 86420, 95123],
            [new DateTimeImmutable('2024-04-20'), 11111, 22222],
            [new DateTimeImmutable('2024-04-21'), 33333, 44444],
            [new DateTimeImmutable('2024-04-22'), 55555, 66666],
            [new DateTimeImmutable('2024-04-23'), 77777, 88888],
            [new DateTimeImmutable('2024-04-24'), 99999, 12345],
            [new DateTimeImmutable('2024-04-25'), 13579, 24680],
            [new DateTimeImmutable('2024-04-26'), 97531, 35792],
            [new DateTimeImmutable('2024-04-27'), 86420, 95123],
            [new DateTimeImmutable('2024-04-28'), 11111, 22222],
            [new DateTimeImmutable('2024-04-29'), 33333, 44444],
            [new DateTimeImmutable('2024-04-30'), 55555, 66666],
            [new DateTimeImmutable('2024-05-01'), 77777, 88888],
            [new DateTimeImmutable('2024-05-02'), 99999, 12345],
            [new DateTimeImmutable('2024-05-03'), 13579, 24680],
            [new DateTimeImmutable('2024-05-04'), 97531, 35792]
        ];
    }
}