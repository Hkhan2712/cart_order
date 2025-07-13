<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\HomeServiceInterface;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(
        protected HomeServiceInterface $homeService
    ) {}

    public function index(): View
    {
        return view('home.index', [
            'categories'   => $this->homeService->getCategories(),
            'bestSelling'  => $this->homeService->getBestSellingProducts(),
            'featured'     => $this->homeService->getFeaturedProducts(),
            'popular'      => $this->homeService->getPopularProducts(),
            'newArrivals'  => $this->homeService->getNewArrivals(),
        ]);
    }
}
