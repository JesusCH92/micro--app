<?php

declare(strict_types=1);

namespace App\Driver\Infrastructure\Controller;

use App\Common\Infrastructure\Framework\SymfonyWebController;
use App\Driver\ApplicationService\DriverGetter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class DriversController extends SymfonyWebController
{
    public function __construct(private readonly DriverGetter $driverGetter)
    {
    }

    #[Route('/drivers', name: 'app_drivers')]
    public function drivers(Request $request): Response
    {
        $drivers = ($this->driverGetter)();

        return $this->render('drivers/index.html.twig', [
            'drivers' => $drivers->items(),
        ]);
    }
}
