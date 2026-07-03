<?php

namespace App\Serializer;

use App\Dto\PaymentDTO;

class StripePaymentMapper implements PaymentMapperInterface
{
    public function supports(string $provider): bool
    {
        return $provider === 'stripe';
    }

    public function map(array $data): PaymentDTO
    {
        return new PaymentDTO(
            transactionId: $data['id'],
            amount: $data['amount'] / 100,
            provider: 'stripe'
        );
    }
}