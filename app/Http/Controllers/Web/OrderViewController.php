<?php 
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\CartService;

class OrderViewController extends Controller {
    public function __construct(protected CartService $cartService) {}

    public function index()
    {
        $cartItems = $this->cartService->getCart();
        // dd($cartItems);
        return view('checkout.index', [
            'cartItems' => $cartItems
        ]);
    }

    public function process() {
        return 0;
    }
}