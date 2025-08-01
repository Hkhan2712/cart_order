<?php 
namespace App\Services\Shipping;

use App\Models\ShippingProvider;

class ShippingFeeCalculator
{
    public function calculateFee(ShippingProvider $provider, array $shipment): int
    {
        $formula = json_decode($provider->fee_formula, true);

        $weight = $shipment['weight'] ?? 0;
        $orderValue = $shipment['order_value'] ?? 0;
        $distance = $shipment['distance'] ?? 0;
        $volume = $shipment['volume'] ?? null;

        if (isset($formula['free_shipping_min_order']) && $orderValue >= $formula['free_shipping_min_order']) {
            return 0;
        }

        $fee = $formula['base_fee'] ?? 0;

        if (isset($formula['per_kg'])) {
            $extraKg = ceil(max(0, $weight - 1000) / 1000);
            $fee += $extraKg * $formula['per_kg'];
        }

        if (isset($formula['per_500g'])) {
            $extraUnits = ceil($weight / 500);
            $fee += $extraUnits * $formula['per_500g'];
        }

        if (($formula['distance_based'] ?? false) && isset($formula['extra_fee_per_km']) && $distance > 0) {
            $fee += $distance * $formula['extra_fee_per_km'];
        }

        if (isset($formula['rural_surcharge']) && ($shipment['is_rural'] ?? false)) {
            $fee += $formula['rural_surcharge'];
        }

        if (isset($formula['insurance_percent'])) {
            $fee += ($orderValue * $formula['insurance_percent']) / 100;
        }

        if (isset($formula['volume_threshold'], $formula['volume_price']) && $volume > $formula['volume_threshold']) {
            $fee += $formula['volume_price'];
        }

        if (isset($formula['max_weight']) && $weight > $formula['max_weight']) {
            throw new \Exception("Weight over permit of shipping provider");
        }

        return (int) ceil($fee); 
    }
}
