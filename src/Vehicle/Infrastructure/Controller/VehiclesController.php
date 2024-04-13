<?php

declare(strict_types=1);

namespace App\Vehicle\Infrastructure\Controller;

use App\Common\Infrastructure\Framework\SymfonyWebController;
use App\Vehicle\ApplicationService\VehicleGetter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class VehiclesController extends SymfonyWebController
{
    public function __construct(private readonly VehicleGetter $vehicleGetter)
    {
    }

    #[Route('/vehicles', name: 'app_vehicles')]
    public function vehicles(Request $request): Response
    {
        $vehicles = ($this->vehicleGetter)();

        return $this->render('vehicles/index.html.twig', [
            'vehicles' => $vehicles->items(),
        ]);
    }
}
