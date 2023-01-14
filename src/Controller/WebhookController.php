<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class WebhookController extends AbstractController
{
    #[Route("/api/webhook", methods: ["POST"])]
    public function receivePayload(Request $request, LoggerInterface $logger)
    {
        $logger->critical($request->getContent(), ["source" => "webhook", "format" => "json"]);

        return $this->json([
            "status" => "OK",
        ]);
    }
}
