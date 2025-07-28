<?php 
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\CartService;

class CartViewController extends Controller {
    public function __construct(protected CartService $cartService) {}

    public function index()
    {
        $cart = $this->cartService->getCart();
        $total = $this->cartService->calculateVAT($cart);
        // dd($cart);
        return view('cart.index', compact('cart', 'total'));
    }
}
