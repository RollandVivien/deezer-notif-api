<?php

namespace App\EventListener;

use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class ExceptionListener
{
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        // $event->setResponse(View::create(['bad request'], Response::HTTP_BAD_REQUEST, []));
        // $response = new JsonResponse([
        //             'statusCode'    => '404',
        //             'message'       => '404 not found',
        //     ]);
        // $response->setStatusCode(404);
        // $response->headers->set('Content-Type', 'application/problem+json');   
        // $event->setResponse($response);
     
    }
}