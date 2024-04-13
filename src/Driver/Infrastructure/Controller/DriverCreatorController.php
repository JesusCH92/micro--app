<?php

declare(strict_types=1);

namespace App\Driver\Infrastructure\Controller;

use App\Common\Infrastructure\Framework\SymfonyWebController;
use App\Driver\ApplicationService\DriverCreator;
use App\Driver\ApplicationService\DTO\DriverCreatorRequest;
use App\Driver\Infrastructure\Framework\Form\DriverFormType;
use App\Driver\Infrastructure\Framework\Form\Model\DriverFormModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class DriverCreatorController extends SymfonyWebController
{
    public function __construct(private readonly DriverCreator $driverCreator)
    {
    }

    #[Route('/driver-creator', name: 'app_driver_creator')]
    public function driverCreator(Request $request): Response
    {
        $model = new DriverFormModel();
        $driverForm = $this->createForm(DriverFormType::class, $model);
        $driverForm->handleRequest($request);

        if ($driverForm->isSubmitted() && $driverForm->isValid()) {
            ($this->driverCreator)(
                new DriverCreatorRequest(
                    $model->getName(),
                    $model->getSurname(),
                    $model->getLicense()
                )
            );

            return $this->redirectToRoute('app_drivers');
        }

        return $this->render('driver_creator/index.html.twig', [
            'form' => $driverForm->createView(),
        ]);
    }
}