<?php 
namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;
use App\Models\Cart;
use App\Models\CartItem;

interface CartRepoInterface extends Repository {
    public function getCart(): Cart;
    public function findOrCreateCart(): mixed;
    public function addProduct(int $productId, int $quantity): void;
    public function removeProduct(int $productId): void;
    public function clear(): void;
    public function getOrCreateCartByUserId(int $userId): Cart;
    public function updateOrCreateCartItem(int $cartId, int $productId, int $quantity): CartItem;
};