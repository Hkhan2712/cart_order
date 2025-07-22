<?php 
namespace App\Http\Controllers\Api;

use App\Http\Requests\AddToCartRequest;
use App\Http\Requests\RemoveFromCartRequest;
use Illuminate\Http\Request;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;

class CartController extends ApiController {
    
    public function __construct(protected CartService $cartService) {}

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
    
    public function update(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = (int) $request->input('quantity');

        try {
            $data = $this->cartService->updateQuantity($productId, $quantity);

            return response()->json([
                'success' => true,
                'data' => [
                    'quantity' => $data['item']['quantity'],
                    'line_total' => $data['item']['total'],
                    'line_total_formatted' => number_format($data['item']['total'], 0, ',', '.') . '₫',
                    'subtotal' => $data['subtotal'],
                    'subtotal_formatted' => number_format($data['subtotal'], 0, ',', '.') . '₫',
                    'vat' => number_format($data['vat'], 0, ',', '.') . '₫',
                    'vat_formatted' => number_format($data['vat'], 0, ',', '.') . '₫',
                    'total_with_vat' => $data['total_with_vat'],
                    'total_with_vat_formatted' => number_format($data['total_with_vat'], 0, ',', '.') . '₫',
                    'total_items' => $data['items_count'],
                ]
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Update failed: ' . $e->getMessage(),
            ], 422);
        }
    }

    public function miniCart() {
        return $this->cartService->getCart();
    }
}