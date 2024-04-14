<?php

declare(strict_types=1);

namespace App\Vehicle\Infrastructure\Api;

use App\Common\Infrastructure\Framework\SymfonyApiController;
use App\Vehicle\ApplicationService\DTO\VehiclesSearcherRequest;
use App\Vehicle\ApplicationService\VehiclesSearcher;
use Symfony\Component\HttpFoundation\JsonResponse;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class VehicleFromTripController extends SymfonyApiController
{
    public function __construct(private readonly VehiclesSearcher $vehiclesSearcher)
    {
    }

    #[OA\Get(
        path: "/api/vehicles-from-trip",
        summary: "show only vehicles which do not have a trip on that date.",
        tags: ["VEHICLE"],
        parameters: [
            new OA\Parameter(
                name: "date",
                description: 'date',
                in: "query",
                required: true,
                example: "2024-12-31"
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Successful operation",
                content: new OA\MediaType(
                    mediaType: "application/json",
                    schema: new OA\Schema(
                        type: "array",
                        items: new OA\Items(
                            properties: [
                                new OA\Property(
                                    property: "id",
                                    description: "vehicle id",
                                    type: "integer",
                                    example: 1
                                ),
                                new OA\Property(
                                    property: "text",
                                    description: "vehicle description",
                                    type: "string",
                                    example: "brand 1 - model 1 - plate 1"
                                )
                            ],
                            type: "object"
                        )
                    )
                )
            )
        ]
    )]
    #[Route('/api/vehicles-from-trip', name: 'app_api_vehicles_from_trip', methods: 'GET')]
    public function vehiclesFromTrip(Request $request): JsonResponse
    {
        $date = $request->get('date');

        $vehicles = ($this->vehiclesSearcher)(new VehiclesSearcherRequest($date));

        return new JsonResponse($vehicles->mappingSelect2(), Response::HTTP_OK);
    }
}
