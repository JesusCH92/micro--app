<?php

declare(strict_types=1);

namespace App\Driver\Infrastructure\Api;

use App\Common\Infrastructure\Framework\SymfonyApiController;
use App\Driver\ApplicationService\DriversSearcher;
use App\Driver\ApplicationService\DTO\DriversSearcherRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class DriveFromTripController extends SymfonyApiController
{
    public function __construct(private readonly DriversSearcher $driversSearcher)
    {
    }

    #[Route('/api/drivers-from-trip', name: 'app_api_drivers_from_trip', methods: 'GET')]
    public function driversFromTrip(Request $request): JsonResponse
    {
        $date = $request->get('date');
        $vehicleId = (int)$request->get('vehicle');

        $drivers = ($this->driversSearcher)(new DriversSearcherRequest($date, $vehicleId));

        return new JsonResponse($drivers->mappingSelect2(), Response::HTTP_OK);
    }
}