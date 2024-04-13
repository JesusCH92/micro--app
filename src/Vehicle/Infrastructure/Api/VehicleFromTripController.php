<?php

declare(strict_types=1);

namespace App\Vehicle\Infrastructure\Api;

use App\Common\Infrastructure\Framework\SymfonyApiController;
use App\Vehicle\ApplicationService\DTO\VehiclesSearcherRequest;
use App\Vehicle\ApplicationService\VehiclesSearcher;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class VehicleFromTripController extends SymfonyApiController
{
    public function __construct(private readonly VehiclesSearcher $vehiclesSearcher)
    {
    }

    #[Route('/api/vehicles-from-trip', name: 'app_api_vehicles_from_trip', methods: 'GET')]
    public function vehiclesFromTrip(Request $request): JsonResponse
    {
        $date    = $request->get('date');

        $vehicles = ($this->vehiclesSearcher)(new VehiclesSearcherRequest($date));

        return new JsonResponse($vehicles->mappingSelect2(), Response::HTTP_OK);
    }
}
