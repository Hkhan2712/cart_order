<?php 
namespace App\Services\Eloquent;

use App\Repositories\Interfaces\CartRepoInterface;
use App\Services\Interfaces\CartServiceInterface;
use Illuminate\Support\Facades\Auth;

class CartService extends Service implements CartServiceInterface {
    public function __construct(
        protected CartRepoInterface $cartRepo
    ) {}

    public function getCart()
    {
        if (Auth::check()) {
            $cart = $this->cartRepo->getCart();

            $items = $cart->items->map(function ($item) {
                $item->total = $item->price * $item->quantity;
                return $item;
            });

            $total = $items->sum(fn ($item) => $item->total);

            return (object)[
                'items' => $items,
                'total' => $total,
                'items_count' => $items->count(),
            ];
        }

        $cart = session()->get('cart', []);

        if (empty($cart['items'])) {
            return (object)[
                'items' => collect(),
                'total' => 0,
                'items_count' => 0,
            ];
        }

        foreach ($cart['items'] as &$item) {
            $item['total'] = $item['price'] * $item['quantity'];
        }

        $total = collect($cart['items'])->sum(fn ($item) => $item['total']);

        return (object)[
            'items' => collect($cart['items']),
            'total' => $total,
            'items_count' => count($cart['items']),
        ];
    }


    public function addToCart(int $productId, int $quantity)
    {
        $this->cartRepo->addProduct($productId, $quantity);
    }

    public function removeFromCart(int $productId)
    {
        $this->cartRepo->removeProduct($productId);
    }

    public function clearCart()
    {
        $this->cartRepo->clear();
    }

    public function updateQuantity(int $productId, int $quantity)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart['items'][$productId]) && Auth::check()) {
            $cart = $this->syncCartFromDatabase();
        }

        if (!isset($cart['items'][$productId])) {
            throw new \Exception("Item not found in cart session.");
        }

        $rawPrice = $cart['items'][$productId]['sale_price'] ?? $cart['items'][$productId]['price'];

        $cart['items'][$productId]['quantity'] = $quantity;
        $cart['items'][$productId]['total'] = $rawPrice * $quantity;

        $subtotal = collect($cart['items'])->sum(fn($item) => $item['total']);
        $vatRate = 0.1;
        $vat = round($subtotal * $vatRate, 0);
        $totalWithVAT = $subtotal + $vat;

        $cart['total'] = $subtotal;
        $cart['vat'] = $vat;
        $cart['total_with_vat'] = $totalWithVAT;

        session()->put('cart', $cart);

        if (Auth::check()) {
            $cartModel = $this->cartRepo->getOrCreateCartByUserId(Auth::id());
            $this->cartRepo->updateOrCreateCartItem($cartModel->id, $productId, $quantity);
        }

        return [
            'item' => $cart['items'][$productId],
            'subtotal' => $subtotal,
            'vat' => $vat,
            'total_with_vat' => $totalWithVAT,
            'items_count' => count($cart['items']),
        ];
    }


    public function calculateVAT($cart, $rate = 0.1)
    {
        if (is_array($cart)) {
            $total = $cart['total'] ?? 0;
        } elseif (is_object($cart)) {
            $total = $cart->total ?? 0;
        } else {
            throw new \InvalidArgumentException('Cart format is not valid');
        }

        $vat = $total * $rate;
        $totalWithVAT = $total + $vat;

        return compact('vat', 'totalWithVAT');
    }

    protected function syncCartFromDatabase(): array
    {
        $cartModel = $this->cartRepo->getOrCreateCartByUserId(Auth::id());
        $cartItems = $cartModel->items;

        $items = [];

        foreach ($cartItems as $item) {
            $product = $item->product;
            $price = $product->sale_price ?? $product->price;

            $items[$product->id] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'thumbnail' => $product->thumbnail,
                'price' => $price,
                'sale_price' => $product->sale_price,
                'quantity' => $item->quantity,
                'total' => $price * $item->quantity,
            ];
        }

        $subtotal = collect($items)->sum('total');
        $vatRate = 0.1;
        $vat = $subtotal * $vatRate;
        $totalWithVAT = $subtotal + $vat;

        $cart = [
            'items' => $items,
            'total' => $subtotal,
            'vat' => $vat,
            'total_with_vat' => $totalWithVAT,
        ];

        session()->put('cart', $cart);

        return $cart;
    }

}