<?php

declare(strict_types=1);

namespace App\Trip\Infrastructure\Controller;

use App\Common\Infrastructure\Framework\SymfonyWebController;
use App\Trip\ApplicationService\TripGetter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class TripsController extends SymfonyWebController
{
    public function __construct(private readonly TripGetter $tripGetter)
    {
    }

    #[Route('/trips', name: 'app_trips')]
    public function trips(Request $request): Response
    {
        $trips = ($this->tripGetter)();

        return $this->render('trips/index.html.twig', [
            'trips' => $trips->items(),
        ]);
    }
}