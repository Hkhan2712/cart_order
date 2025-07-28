<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            ['name' => 'view_dashboard',        'description' => 'Xem dashboard tổng quan'],
            ['name' => 'manage_products',       'description' => 'Quản lý sản phẩm'],
            ['name' => 'manage_categories',     'description' => 'Quản lý danh mục'],
            ['name' => 'manage_orders',         'description' => 'Quản lý đơn hàng'],
            ['name' => 'manage_users',          'description' => 'Quản lý người dùng'],
            ['name' => 'manage_roles',          'description' => 'Quản lý vai trò'],
            ['name' => 'manage_coupons',        'description' => 'Quản lý mã giảm giá'],
            ['name' => 'manage_inventory_logs', 'description' => 'Theo dõi biến động kho'],
            ['name' => 'manage_reviews',        'description' => 'Quản lý đánh giá'],
        ];

        foreach ($permissions as $permission) {
            DB::table('permissions')->updateOrInsert(
                ['name' => $permission['name']],
                array_merge($permission, ['created_at' => now(), 'updated_at' => now()])
            );
        }

        $adminRoleId = DB::table('roles')->where('name', 'admin')->value('id');

        $permissionIds = DB::table('permissions')->pluck('id');

        foreach ($permissionIds as $permissionId) {
            DB::table('role_permission')->updateOrInsert([
                'role_id' => $adminRoleId,
                'permission_id' => $permissionId
            ]);
        }
    }
}
