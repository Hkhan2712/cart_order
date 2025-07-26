<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            // ['name' => 'admin', 'description' => 'Admin of AquaTerra'],
            // ['name' => 'user',  'description' => 'Buyers'],
            ['name' => 'staff', 'description' => 'Order manager'],
            ['name' => 'support', 'description' => 'Customer support'],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->updateOrInsert(
                ['name' => $role['name']],
                array_merge($role, ['created_at' => now(), 'updated_at' => now()])
            );
        }
    }
}
