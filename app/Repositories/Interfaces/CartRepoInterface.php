<?php 
namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;
use App\Models\Cart;

interface CartRepoInterface extends Repository {
    public function getCart(): Cart;
    public function findOrCreateCart(): mixed;
    public function addProduct(int $productId, int $quantity): void;
    public function removeProduct(int $productId): void;
    public function clear(): void;
};