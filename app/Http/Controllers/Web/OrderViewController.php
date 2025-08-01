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

    public function process(CheckoutRequest $request)
    {
        $data = $request->validated();
        dd($data);
        $order = $this->orderService->createOrder($data);

        if (!$order) {
            return back()->withErrors(['error' => 'Could not create order.']);
        }

        if ($data['payment_method'] !== 'cod') {
            return redirect()->route('payment.redirect', ['order_id' => $order->id]);
        }

        $this->cartService->clearCart();

        return redirect()->route('checkout.success')->with('order', $order);
    }
}