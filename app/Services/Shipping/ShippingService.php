<?php

namespace App\Services\Shipping;

use App\Repositories\ShippingProviderRepo;
use App\Services\Shipping\ShippingFeeCalculator;
use App\Models\ShippingProvider;

class ShippingService
{
    public function __construct(
        protected ShippingProviderRepo $shippingProviderRepo,
        protected ShippingFeeCalculator $shippingFeeCalculator,
    ) {}

    public function calFeeShipping(array $input): int
    {
        $provider = $this->shippingProviderRepo->findByCode($input['provider_code']);
        if (!$provider instanceof ShippingProvider) {
            throw new \Exception("Not found Shipping Provider");
        }

        $shipment = [
            'weight' => $input['weight'] ?? 0,
            'order_value' => $input['order_value'] ?? 0,
            'distance' => $input['distance'] ?? 0,
            'is_rural' => $input['is_rural'] ?? false,
            'volume' => $input['volume'] ?? null,
        ];

        return $this->shippingFeeCalculator->calculateFee($provider, $shipment);
    }
    
    public function selectProvider(array $shipment, string $shippingAddress) : string {
        return 'GHTK';
    }
}
