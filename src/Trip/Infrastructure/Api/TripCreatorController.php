<?php

declare(strict_types=1);

namespace App\Trip\Infrastructure\Api;

use App\Common\Infrastructure\Framework\SymfonyApiController;
use App\Trip\ApplicationService\DTO\TripCreatorRequest;
use App\Trip\ApplicationService\TripCreator;
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

    #[Route('/api/trip-creator', name: 'app_api_trip_creator', methods: 'POST')]
    public function tripCreator(Request $request): JsonResponse
    {
        $data = $this->serializer->deserialize($request->getContent(), TripCreatorRequest::class, 'json');

        $trip = ($this->tripCreator)($data);

        return new JsonResponse($trip->__serialize(), Response::HTTP_CREATED);
    }
}