<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepo;
use App\Services\DashboardService;

class DashboardController extends Controller
{
    public function __construct(protected DashboardService $dashboardService)
    {
        
    }
    public function index() {
        $data = $this->dashboardService->getStat();       
        return view('admin.dashboard.index', $data);
    }
}