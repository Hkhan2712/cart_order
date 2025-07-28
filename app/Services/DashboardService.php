<?php 
namespace App\Services;

use App\Models\Order;
use App\Repositories\OrderRepo;
use App\Repositories\ProductRepo;
use App\Repositories\UserRepo;

class DashboardService {
    
    public function __construct(
        protected OrderRepo $orderRepo,
        protected ProductRepo $productRepo,
        protected UserRepo $userRepo,
    ) 
    {
        
    }

    public function getStat(): array {
        $revenue = $this->orderRepo->getRevenueMonth();
        $goalCompletions = $this->orderRepo->getCompletedOrdersMonth();
        $newUsers = $this->userRepo->countNewUsersMonth();
        $latestOrders = $this->orderRepo->getLastestOrders(10);
        $recentProducts = $this->productRepo->latestByCreatedAt(10);

        $smallBox = [
            'newOrders' => $this->orderRepo->countNewOrdersMonth(),
            'totalRevenue' => number_format($revenue, 2), 
            'userRegistrations' => $newUsers,
            'inventory' => $this->productRepo->countLowInventoryProducts(),
        ];

        $goals = [
            ['label' => 'Add to cart', 'current' => 160, 'total' => 200, 'color' => 'primary'],
            ['label' => 'Complete purchase', 'current' => 310, 'total' => 400, 'color' => 'danger'],
            ['label' => 'Visit premium', 'current' => 480, 'total' => 800, 'color' => 'success'],
            ['label' => 'Send inquiries', 'current' => 250, 'total' => 500, 'color' => 'warning'],
        ];

        $summary = [
            ['label' => 'Total Revenue', 'value' => number_format($revenue, 0), 'trend' => 'success', 'icon' => 'bi-caret-up-fill', 'change' => '17%'],
            ['label' => 'Total Cost', 'value' => '10,390.90', 'trend' => 'info', 'icon' => 'bi-caret-left-fill', 'change' => '0%'],
            ['label' => 'Total Profit', 'value' => number_format($revenue - 10390.90, 2), 'trend' => 'success', 'icon' => 'bi-caret-up-fill', 'change' => '20%'],
            ['label' => 'Goal Completions', 'value' => (string) $goalCompletions, 'trend' => 'danger', 'icon' => 'bi-caret-down-fill', 'change' => '18%'],
        ];

        return compact(
            'revenue',
            'goalCompletions',
            'newUsers',
            'latestOrders',
            'recentProducts',
            'smallBox',
            'goals',
            'summary',
        );
    }
}