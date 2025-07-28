<?php 
namespace App\Services;

use App\Repositories\OrderRepo;

class DashboardService {
    
    public function __construct(protected OrderRepo $orderRepo) 
    {
        
    }

    public function getStat() {
        
    }
}