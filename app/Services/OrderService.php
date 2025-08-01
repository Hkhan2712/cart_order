<?php 
namespace App\Services;

use App\Services\CartService;
use App\Repositories\OrderRepo;
use App\Repositories\ProductRepo;
use App\Services\Shipping\ShippingService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderService 
{
    public function __construct(
        protected CartService $cartService,
        protected OrderRepo $orderRepo,
        protected ProductRepo $productRepo,
        protected ShippingService $shippingService,
    ){}
     
    // public function createOrder(array $data) {
    //     $cart = $this->cartService->getCart();

    //     if ($cart->items_count == 0) {
    //         throw new Exception("Cart is empty!");
    //     }
    //     dd($cart, $data);
    //     return DB::transaction(function () use ($cart, $data) {
    //         $vatData = $this->cartService->calculateVAT($cart);
    //         $subtotal = $cart->total;
    //         $vat = $vatData['vat'];
    //         $total = $vatData['totalWithVAT'];

    //         $order = $this->orderRepo
    //                 ->create([
    //                     'user_id' => Auth::id(),
    //                     'subtotal' => $subtotal,
    //                     'vat' => $vat,
    //                     'total' => $total,
    //                     'payment_method' => $data['payment_method'],
    //                     'shipping_provider' => $data['shipping_provider'],
    //                     'shipping_address' => $data['shipping_address'],
    //                     'recipient_name' => $data['recipient_name'],
    //                     'recipient_phone' => $data['recipient_phone'],
    //                     'status' => 'pending',  
    //                 ]);
    //         foreach ($cart->items as $item) {
    //             $order->items()->create([
    //                 'product_id' => $item['product_id'],
    //                 'quantity' => $item['quantity'],
    //                 'price' => $item['price'],
    //                 'total' => $item['subtotal'],
    //             ]);
                
    //             $this->productRepo->decreaseStock($item['product_id'], $item['quantity']);
    //         }

    //         $this->cartService->clearCart();

    //         return $order;
    //     });
    // }
    public function createOrder(array $data) {
        $cart = $this->cartService->getCart();

        if ($cart->items_count == 0) {
            throw new Exception("Cart is empty!");
        }

        $shipment = [
            'weight' => $cart->total_weight,
            'order_value' => $cart->total,
            'distance' => $data['distance'] ?? 0,
            'is_rural' => $data['is_rural'] ?? false,
            'volume' => $data['volume'] ?? null,
        ];

        $shippingFee = $this->shippingService->calFeeShipping(
            $data['shipping_provider'],
            $shipment
        );

        return DB::transaction(function () use ($cart, $data, $shippingFee) {
            $vatData = $this->cartService->calculateVAT($cart);
            $subtotal = $cart->total;
            $vat = $vatData['vat'];
            $total = $vatData['totalWithVAT'] + $shippingFee;

            $order = $this->orderRepo
                    ->create([
                        'user_id' => Auth::id(),
                        'subtotal' => $subtotal,
                        'vat' => $vat,
                        'shipping_fee' => $shippingFee, 
                        'total' => $total,
                        'payment_method' => $data['payment_method'],
                        'shipping_provider' => $data['shipping_provider'],
                        'shipping_address' => $data['shipping_address'],
                        'recipient_name' => $data['recipient_name'],
                        'recipient_phone' => $data['recipient_phone'],
                        'status' => 'pending',  
                    ]);

            foreach ($cart->items as $item) {
                $order->items()->create([
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total' => $item['subtotal'],
                ]);
                
                $this->productRepo->decreaseStock($item['product_id'], $item['quantity']);
            }

            $this->cartService->clearCart();

            return $order;
        });
    }
}