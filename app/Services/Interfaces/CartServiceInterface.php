<?php 
namespace App\Services\Interfaces;

interface CartServiceInterface extends ServiceInterface {
    public function getCart();
    public function addToCart(int $productId, int $quantity);
    public function removeFromCart(int $productId);
    public function clearCart();
}