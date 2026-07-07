<?php

namespace App\Controller;

use App\Dto\PaymentDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

final class PaymentController extends AbstractController
{
    #[Route('/webhook/payment/{provider}', name: 'app_payment', methods: ['POST'])]
    public function handleWebhook(
        string $provider,
        Request $request,
        SerializerInterface $serializer,
    ): Response
    {

        $JsonContent = $request->getContent();

        $paymentDTO = $serializer->deserialize($JsonContent, PaymentDTO::class, 'json', [
            'provider' => $provider,
        ]);

        return $this->json($paymentDTO);
    }
}
