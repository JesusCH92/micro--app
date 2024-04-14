<?php

declare(strict_types=1);

namespace App\Driver\Infrastructure\Api;

use App\Common\Infrastructure\Framework\SymfonyApiController;
use App\Driver\ApplicationService\DriversSearcher;
use App\Driver\ApplicationService\DTO\DriversSearcherRequest;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class DriveFromTripController extends SymfonyApiController
{
    public function __construct(private readonly DriversSearcher $driversSearcher)
    {
    }

    #[OA\Get(
        path: "/api/drivers-from-trip",
        summary: "Show only drivers who do not have a trip on that date AND whose license is the same as the selected vehicle.",
        tags: ["DRIVER"],
        parameters: [
            new OA\Parameter(
                name: "date",
                description: 'date',
                in: "query",
                required: true,
                example: "2024-01-01"
            ),
            new OA\Parameter(
                name: "vehicle",
                description: 'vehicle ID',
                in: "query",
                required: true,
                example: "1"
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
                                    description: "driver id",
                                    type: "integer",
                                    example: 1
                                ),
                                new OA\Property(
                                    property: "text",
                                    description: "driver description",
                                    type: "string",
                                    example: "name 1 - surname 1 - 1"
                                )
                            ],
                            type: "object"
                        )
                    )
                )
            )
        ]
    )]
    #[Route('/api/drivers-from-trip', name: 'app_api_drivers_from_trip', methods: 'GET')]
    public function driversFromTrip(Request $request): JsonResponse
    {
        $date      = $request->get('date');
        $vehicleId = (int)$request->get('vehicle');

        $drivers = ($this->driversSearcher)(new DriversSearcherRequest($date, $vehicleId));

        return new JsonResponse($drivers->mappingSelect2(), Response::HTTP_OK);
    }
}
