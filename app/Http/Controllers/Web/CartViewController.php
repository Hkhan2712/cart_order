<?php 
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\CartServiceInterface;

class CartViewController extends Controller {
    public function __construct(protected CartServiceInterface $cartService) {}

    public function index()
    {
        $cart = $this->cartService->getCart();
        return view('cart.index', compact('cart'));
    }
}