<?php

declare(strict_types=1);

namespace App\Vehicle\Infrastructure\Controller;

use App\Common\Infrastructure\Framework\SymfonyWebController;
use App\Vehicle\ApplicationService\VehicleDeleter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class VehicleDeleterController extends SymfonyWebController
{
    public function __construct(private readonly VehicleDeleter $vehicleDeleter)
    {
    }

    #[Route('/vehicle-deleter/{id}', name: 'app_vehicle_deleter')]
    public function vehicleDeleter(int $id): Response
    {
        ($this->vehicleDeleter)($id);
        return $this->redirectToRoute('app_vehicles');
    }
}
