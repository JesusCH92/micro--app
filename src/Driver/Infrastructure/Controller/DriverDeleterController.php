<?php

declare(strict_types=1);

namespace App\Driver\Infrastructure\Controller;

use App\Common\Infrastructure\Framework\SymfonyWebController;
use App\Driver\ApplicationService\DriverDeleter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class DriverDeleterController extends SymfonyWebController
{
    public function __construct(private readonly DriverDeleter $driverDeleter)
    {
    }

    #[Route('/driver-deleter/{id}', name: 'app_driver_deleter')]
    public function driverDeleter(int $id): Response
    {
        ($this->driverDeleter)($id);
        return $this->redirectToRoute('app_drivers');
    }
}