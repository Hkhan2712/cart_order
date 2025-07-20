<?php 
namespace App\Http\Controllers\Api;

use App\Http\Requests\AddToCartRequest;
use App\Http\Requests\RemoveFromCartRequest;
use Illuminate\Http\Request;
use App\Services\Interfaces\CartServiceInterface;

class CartController extends ApiController {
    
    public function __construct(protected CartServiceInterface $cartService) {}

     public function add(AddToCartRequest $request)
    {
        $this->cartService->addToCart(
            $request->input('product_id'),
            $request->input('quantity')
        );

        return response()->json([
            'message' => 'Product have been added to cart']);
    }

    public function remove(RemoveFromCartRequest $request)
    {
        $this->cartService->removeFromCart($request->product_id);
        return response()->json(['message' => 'Removed product from cart']);
    }

    public function miniCart()
    {
        $cart = $this->cartService->getCart();

        return response()->json([
            'items' => $cart->items->map(function ($item) {
                return [
                    'product_id' => $item->product_id,
                    'name' => $item->product->name,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                    'subtotal' => $item->price * $item->quantity,
                    'image' => $item->product->thumbnail_url,
                ];
            }),
            'total' => $cart->items->sum(fn ($i) => $i->price * $i->quantity)
        ]);
    }
}