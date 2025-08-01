<?php 
namespace App\Repositories;

use App\Models\ShippingProvider;

class ShippingProviderRepo extends BaseRepo {
    protected function model():string { return ShippingProvider::class; }
    
    public function findByCode(string $code) {
        return $this->model->where('code', $code)->first();
    }
} 