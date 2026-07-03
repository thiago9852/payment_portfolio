<?php

namespace App\Serializer;

use App\Dto\PaymentDTO;

interface PaymentMapperInterface
{
    public function supports(string $provider): bool;
    public function map(array $data): PaymentDTO;
}