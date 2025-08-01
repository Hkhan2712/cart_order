<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingProviderFeeSeeder extends Seeder
{
    public function run()
    {
        $providers = [
            'GHTK' => [
                "base_fee" => 15000,
                "per_kg" => 5000,
                "max_weight" => 30000,
                "extra_fee_per_km" => 0,
                "free_shipping_min_order" => 300000,
            ],
            'GHN' => [
                "base_fee" => 12000,
                "per_kg" => 4000,
                "max_weight" => 50000,
                "distance_based" => true,
                "extra_fee_per_km" => 1000,
            ],
            'VTP' => [
                "base_fee" => 18000,
                "per_kg" => 3500,
                "max_weight" => 40000,
                "insurance_percent" => 1.5,
            ],
            'VNPOST' => [
                "base_fee" => 20000,
                "per_500g" => 3000,
                "max_weight" => 20000,
                "rural_surcharge" => 5000,
            ],
            'JNT' => [
                "base_fee" => 14000,
                "per_kg" => 4500,
                "max_weight" => 30000,
                "volume_threshold" => 30000,
                "volume_price" => 4000,
            ],
        ];

        foreach ($providers as $code => $feeFormula) {
            DB::table('shipping_providers')
                ->where('code', $code) // giả sử bạn có cột 'code'
                ->update([
                    'fee_formula' => json_encode($feeFormula, JSON_UNESCAPED_UNICODE)
                ]);
        }
    }
}
