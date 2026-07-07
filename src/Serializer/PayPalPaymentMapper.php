<?php

namespace App\Serializer;

use App\Dto\PaymentDTO;

class PayPalPaymentMapper implements PaymentMapperInterface
{
    public function supports(string $provider): bool
    {
        return $provider === 'paypal';
    }

    public function map(array $data): PaymentDTO
    {
        return new PaymentDTO(
            transactionId: $data['txn_id'],
            amount: (float) $data['payment_amount'],
            provider: 'paypal',
        );
    }
}