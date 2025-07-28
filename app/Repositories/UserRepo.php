<?php 
namespace App\Repositories;

use App\Models\User;

class UserRepo extends BaseRepo {

    protected function model(): string { return User::class; }

    public function countNewUsersMonth() {
        return $this->model::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
    }
}