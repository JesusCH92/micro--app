<?php

declare(strict_types=1);

namespace App\Vehicle\Infrastructure\Controller;

use App\Common\Infrastructure\Framework\SymfonyWebController;
use App\Vehicle\ApplicationService\DTO\VehicleCreatorRequest;
use App\Vehicle\ApplicationService\VehicleCreator;
use App\Vehicle\Infrastructure\Framework\Form\Model\VehicleFormModel;
use App\Vehicle\Infrastructure\Framework\Form\VehicleFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class VehicleCreatorController extends SymfonyWebController
{
    public function __construct(private readonly VehicleCreator $vehicleCreator)
    {
    }

    #[Route('/vehicle-creator', name: 'app_vehicle_creator')]
    public function vehicleCreator(Request $request): Response
    {
        $model = new VehicleFormModel();
        $vehicleForm = $this->createForm(VehicleFormType::class, $model);
        $vehicleForm->handleRequest($request);

        if ($vehicleForm->isSubmitted() && $vehicleForm->isValid()) {
            ($this->vehicleCreator)(
                new VehicleCreatorRequest(
                    $model->brand(),
                    $model->model(),
                    $model->plate(),
                    $model->licenseRequired()
                )
            );

            return $this->redirectToRoute('app_vehicles');
        }

        return $this->render('vehicle_creator/index.html.twig', [
            'form' => $vehicleForm->createView(),
        ]);
    }
}
