<?php 
namespace App\Repositories;

use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderRepo extends BaseRepo 
{
    protected function model(): string { return Order::class; }

    public function getRevenueMonth(): float
    {
        $baseRevenue = Order::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum(DB::raw('total_amount + shipping_fee'));

        return $baseRevenue * 1.1; 
    }

    public function getCompletedOrdersMonth(): int
    {
        return Order::where('order_status', 'completed')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
    }
    public function getLastestOrders(int $limit) {
        return $this->model::with('user')->latest()->take($limit)->get();
    }
    public function countNewOrdersMonth(): int
    {
        return $this->model->whereMonth('created_at', now()->month)->count();
    }
    public function getSalesDataMonth(): array
    {
        $daysInMonth = now()->daysInMonth;

        $salesData = $this->model::selectRaw('DATE(created_at) as date, COUNT(*) as orders_count, SUM(total_amount + shipping_fee) as total')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        $data = [];

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = now()->startOfMonth()->addDays($day - 1)->toDateString();

            $data[] = [
                'date' => $date,
                'orders' => $salesData[$date]->orders_count ?? 0,
                'revenue' => round(($salesData[$date]->total ?? 0) * 1.1),
            ];
        }

        return $data;
    }
}