<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepo;

class DashboardController extends Controller
{
    public function __construct(protected ProductRepo $productRepo)
    {
        
    }
    public function index() {
        $latestProducts = $this->productRepo->latestByCreatedAt(10);

        return view('admin.dashboard.index', [
            'totalOrders' => 0,
            'todayRevenue' => 0,
            'userCount' => 0,
            'inStockCount' => 0,
            'recentProducts' => $latestProducts,
        ]);
    }
}