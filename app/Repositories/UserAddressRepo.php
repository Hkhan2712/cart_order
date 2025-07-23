<?php 
namespace App\Repositories;

use App\Models\ShippingAddress;

class UserAddressRepo extends BaseRepo {
    public function model(): string { return ShippingAddress::class;}
    
    public function allByUser(int $userId) 
    {
        return $this->model
            ->where('user_id', $userId)
            ->orderByDesc('is_default') 
            ->latest()
            ->get();
    }

    public function findByUser($id, $userId) {
        return $this->model->where('id', $id)->where('user_id'. $userId)->first();
    }

    public function deleteByUser(int $id, int $userId) {
        return $this->model
            ->where('id', $id)
            ->where('user_id', $userId)
            ->delete() > 0;
    }
    public function setDefault(int $id, int $userId): bool
    {
        $address = $this->model
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();

        if (!$address) return false;

        if ($address->is_default) return true;

        $this->model
            ->where('user_id', $userId)
            ->where('is_default', true)
            ->update(['is_default' => false]);

        return $address->update(['is_default' => true]);
    }
} 