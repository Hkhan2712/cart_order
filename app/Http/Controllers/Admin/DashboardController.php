<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index() {
        return view('admin.dashboard.index', [
            'totalOrders' => 0,
            'todayRevenue' => 0,
            'userCount' => 0,
            'inStockCount' => 0,
        ]);
    }
}