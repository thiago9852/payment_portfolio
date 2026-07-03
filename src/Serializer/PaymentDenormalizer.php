<?php

namespace App\Serializer;

use App\Dto\PaymentDTO;
use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class PaymentDenormalizer implements DenormalizerInterface
{

    /**
     * @param iterable<PaymentMapperInterface> $mappers
     */
    public function __construct(
        #[AutowireIterator('app.payment_mapper')]
        private iterable $mappers
    ) { }


    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === PaymentDTO::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $provider = $context['provider'] ?? '';

        foreach ($this->mappers as $mapper) {
            if ($mapper->supports($provider)) {
                return $mapper->map($data);
            }
        }

        throw new \InvalidArgumentException("Provider {$provider} not supported");
    }
    
    public function getSupportedTypes(?string $format): array
    {
        return [PaymentDTO::class => true];
    }
}