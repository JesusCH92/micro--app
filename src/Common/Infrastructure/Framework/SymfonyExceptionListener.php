<?php

namespace App\Common\Infrastructure\Framework;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class SymfonyExceptionListener
{
    public function __invoke(ExceptionEvent $event): void
    {
        // You get the exception object from the received event
        $exception = $event->getThrowable();
        $message = $exception->getMessage();

        // Determine if the route name has the prefix "app_api_"
        $routeName = $event->getRequest()->attributes->get('_route');
        $isApiRoute = str_starts_with($routeName, 'app_api_');

        // Customize your response object to display the exception details
        if ($isApiRoute) {
            $response = new JsonResponse();
            $response->setData(['ok' => false, 'error' => ['message' => $message]]);
            $response->headers->set('Content-Type', 'application/json');
        } else {
            $response = new Response($message);
        }

        // HttpExceptionInterface is a special type of exception that
        // holds status code and header details
        if ($exception instanceof HttpExceptionInterface) {
            $response->setStatusCode($exception->getStatusCode());
            if (!$isApiRoute) {
                $response->headers->replace($exception->getHeaders());
            }
        } else {
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        // sends the modified response object to the event
        $event->setResponse($response);
    }
}