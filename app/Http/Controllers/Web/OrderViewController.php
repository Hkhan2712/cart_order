<?php 
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Services\CartService;
use App\Services\OrderService;

class OrderViewController extends Controller {
    public function __construct(
        protected CartService $cartService,
        protected OrderService $orderService,
    ) {}

    public function index()
    {
        $cartItems = $this->cartService->getCart();
        // dd($cartItems);
        return view('orders.index', [
            'cartItems' => $cartItems
        ]);
    }

    public function process(CheckoutRequest $request) {
        $order = $this->orderService->createOrder($request->validated());

        if ($request->input('pay-method') !== 'cod') {
            return redirect()->route('payment.redirect', ['order_id' => $order->id]);
        }

        $this->cartService->clearCart();
        return redirect()->route('checkout.success')->with('order', $order);
    }
}