<?php 
namespace App\Repositories;

use App\Models\Cart;
use App\Models\Product;

class CartRepo extends BaseRepo {
    protected function model(): string { return Cart::class; }

    public function getCartByUserId(int $userId): ?Cart
    {
        return Cart::where('user_id', $userId)->first();
    }

    public function getCartBySessionId(string $sessionId): ?Cart
    {
        return Cart::where('session_id', $sessionId)->first();
    }

    public function createCartForUser(int $userId): Cart
    {
        return Cart::create(['user_id' => $userId]);
    }

    public function createCartForSession(string $sessionId): Cart
    {
        return Cart::create(['session_id' => $sessionId]);
    }

    public function loadCartRelations(Cart $cart): Cart
    {
        return $cart->load('items.product.images', 'items.product.category');
    }

    public function addOrUpdateItem(Cart $cart, Product $product, int $quantity): void
    {
        $item = $cart->items()->where('product_id', $product->id)->first();
        $price = $product->sale_price ?? $product->price;

        if ($item) {
            $item->update([
                'quantity' => $item->quantity + $quantity,
                'price' => $price,
            ]);
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $price,
            ]);
        }
    }

    public function removeItem(Cart $cart, int $productId): void
    {
        $cart->items()->where('product_id', $productId)->delete();
    }

    public function clearItems(Cart $cart): void
    {
        $cart->items()->delete();
    }
}
