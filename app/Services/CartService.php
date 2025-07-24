<?php 
namespace App\Services;

use App\Models\Product;
use App\Repositories\CartRepo;
use App\Services\CartContextResolver;

class CartService extends Service
{
    public function __construct(
        protected CartRepo $cartRepo,
        protected CartContextResolver $context
    ) {}

    public function getCart(): object
    {
        $cart = $this->cartRepo->loadCartRelations(
            $this->context->resolve()
        );
        $items = $cart->items->map(fn ($item) => [
            'product_id' => $item->product_id,
            'name' => $item->product->name,
            'price' => $item->product->price,
            'quantity' => $item->quantity,
            'sale_price' => $item->product->sale_price ?? 0,
            'slug' => $item->product->slug,
            'subtotal' => $item->price * $item->quantity,
            'image' => $item->product->image_path,
        ]);

        return (object)[
            'items' => $items,
            'total' => $items->sum(fn ($i) => $i['subtotal']),
            'items_count' => $items->count(),
        ];
    }

    public function addToCart(int $productId, int $quantity): void
    {
        $cart = $this->context->resolve();
        $product = Product::findOrFail($productId);
        $this->cartRepo->addItem($cart, $product, $quantity);
    }

    public function removeFromCart(int $productId): array
    {
        $cart = $this->context->resolve();
        $this->cartRepo->removeItem($cart, $productId);

        $cartData = $this->getCart();
        $vatData = $this->calculateVAT($cartData);

        return [
            'subtotal' => $cartData->total,
            'subtotal_formatted' => number_format($cartData->total, 0, ',', '.') . '₫',
            'vat' => $vatData['vat'],
            'vat_formatted' => number_format($vatData['vat'], 0, ',', '.') . '₫',
            'total_with_vat' => $vatData['totalWithVAT'],
            'total_with_vat_formatted' => number_format($vatData['totalWithVAT'], 0, ',', '.') . '₫',
            'total_items' => $cartData->items_count,
        ];
    }

    public function clearCart()
    {
        $this->cartRepo->clearItems($this->context->resolve());
    }

    public function updateQuantity(int $productId, int $quantity)
    {
        $cart = $this->context->resolve();
        $product = Product::findOrFail($productId);

        $this->cartRepo->updateItem($cart, $product, $quantity);

        $cartData = $this->getCart();
        $vatData = $this->calculateVAT($cartData);

        $item = $cartData->items->firstWhere('product_id', $productId);

        return [
            'item' => [
                'quantity' => $item['quantity'],
                'total' => $item['subtotal'],
            ],
            'subtotal' => $cartData->total,
            'vat' => $vatData['vat'],
            'total_with_vat' => $vatData['totalWithVAT'],
            'items_count' => $cartData->items_count,
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
}
