<?php 
namespace App\Services\Eloquent;

use App\Repositories\Interfaces\CartRepoInterface;
use App\Services\Interfaces\CartServiceInterface;

class CartService extends Service implements CartServiceInterface {
    public function __construct(
        protected CartRepoInterface $cartRepo
    ) {}

    public function getCart()
    {
        return $this->cartRepo->getCart();
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
}