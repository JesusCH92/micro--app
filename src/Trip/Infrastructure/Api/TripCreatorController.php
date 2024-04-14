<?php

declare(strict_types=1);

namespace App\Trip\Infrastructure\Api;

use App\Common\Infrastructure\Framework\SymfonyApiController;
use App\Trip\ApplicationService\DTO\TripCreatorRequest;
use App\Trip\ApplicationService\TripCreator;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

final class TripCreatorController extends SymfonyApiController
{
    public function __construct(
        private readonly SerializerInterface $serializer,
        private readonly TripCreator $tripCreator
    ) {
    }

    #[OA\Post(
        path: "/api/trip-creator",
        summary: "Save a trip with vehicle, driver and date",
        requestBody: new OA\RequestBody(
            content: new OA\MediaType(
                mediaType: "application/json",
                schema: new OA\Schema(
                    required: ["date", "vehicle"],
                    properties: [
                        new OA\Property(
                            property: "date",
                            description: "date for trip",
                            type: "string",
                            example: "2024-12-01"
                        ),
                        new OA\Property(
                            property: "vehicle",
                            description: 'vehicle ID',
                            type: "integer",
                            example: 1
                        ),
                        new OA\Property(
                            property: "driver",
                            description: 'driver ID',
                            type: "integer",
                            example: 1
                        )
                    ],
                    type: "object"
                )
            )
        ),
        tags: ["TRIP"],
        responses: [
            new OA\Response(
                response: 201,
                description: "Successful operation",
                content: new OA\MediaType(
                    mediaType: "application/json",
                    schema: new OA\Schema(
                        properties: [
                            new OA\Property(
                                property: "id",
                                description: "Trip ID",
                                type: "integer"
                            ),
                            new OA\Property(
                                property: "vehicle",
                                description: "vehicle description from trip",
                                type: "string"
                            ),
                            new OA\Property(
                                property: "driver",
                                description: "driver description from trip",
                                type: "string"
                            ),
                            new OA\Property(
                                property: "date",
                                description: "date at trip",
                                type: "string"
                            )
                        ],
                        type: "object"
                    )
                )
            )
        ]
    )]
    #[Route('/api/trip-creator', name: 'app_api_trip_creator', methods: 'POST')]
    public function tripCreator(Request $request): JsonResponse
    {
        $data = $this->serializer->deserialize($request->getContent(), TripCreatorRequest::class, 'json');

        $trip = ($this->tripCreator)($data);

        return new JsonResponse($trip->__serialize(), Response::HTTP_CREATED);
    }
}