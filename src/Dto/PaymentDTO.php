<?php

namespace App\Dto;

class PaymentDTO
{

    public function __construct(
        public readonly string $transactionId,
        public readonly float $amount,
        public readonly string $provider,
    ) { }
}