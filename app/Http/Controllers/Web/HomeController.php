<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\HomeServiceInterface;
use Illuminate\View\View;

class HomeController extends Controller
{
    protected HomeServiceInterface $homeService;

    public function __construct(HomeServiceInterface $homeService)
    {
        $this->homeService = $homeService;
    }

    public function index(): View
    {
        $categories        = $this->homeService->getCategories();
        $bestSelling       = $this->homeService->getBestSellingProducts();
        $featured          = $this->homeService->getFeaturedProducts();
        $popular           = $this->homeService->getPopularProducts();
        $newArrivals       = $this->homeService->getNewArrivals();

        return view('home.index', compact(
            'categories',
            'bestSelling',
            'featured',
            'popular',
            'newArrivals'
        ));
    }
}
