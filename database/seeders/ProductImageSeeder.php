<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductImageSeeder extends Seeder
{
    public function run(): void
    {
        $images = [];

        for ($i = 1; $i <= 20; $i++) {
            $images[] = [
                'product_id' => $i,
                'image_path' => "products/{$i}.jpg",
                'is_primary' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('product_images')->insert($images);
    }
}
