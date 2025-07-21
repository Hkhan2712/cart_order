<?php 
namespace App\Repositories\Eloquent;

use App\Models\Cart;
use App\Models\CartItem;
use App\Repositories\Interfaces\CartRepoInterface;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartRepo extends BaseRepo implements CartRepoInterface
{
    protected ?Cart $cart = null;

    protected function model(): string { return Cart::class; }

    public function findOrCreateCart(): mixed
    {
        if ($this->cart) return $this->cart;

        if (Auth::check()) {
            $this->cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        } else {
            $sessionId = Session::getId();
            $this->cart = Cart::firstOrCreate(['session_id' => $sessionId]);
        }

        return $this->cart;
    }

    public function getCart(): Cart
    {
        return $this->findOrCreateCart()->load('items.product.images', 'items.product.category');
    }

    public function addProduct(int $productId, int $quantity): void
    {
        $cart = $this->findOrCreateCart();
        $product = Product::findOrFail($productId);
        $item = $cart->items()->where('product_id', $productId)->first();

        if ($item) {
            $item->increment('quantity', $quantity);
        } else {
            $cart->items()->create([
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $product->sale_price ?? $product->price,
            ]);
        }
    }

    public function removeProduct(int $productId): void
    {
        $cart = $this->findOrCreateCart();
        $cart->items()->where('product_id', $productId)->delete();
    }

    public function clear(): void
    {
        $this->findOrCreateCart()->items()->delete();
    }

    public function getOrCreateCartByUserId(int $userId): Cart
    {
        return Cart::firstOrCreate(['user_id' => $userId]);
    }

    public function updateOrCreateCartItem(int $cartId, int $productId, int $quantity): CartItem
    {
        return CartItem::updateOrCreate(
            ['cart_id' => $cartId, 'product_id' => $productId],
            ['quantity' => $quantity]
        );
    }
}
