<?php
namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Session;
use App\Models\Cart;

class MergeCartOnLogin
{
    public function handle(Login $event): void
    {
        $sessionId = Session::getId();
        $userId = $event->user->id;

        $sessionCart = Cart::where('session_id', $sessionId)->with('items')->first();
        if (!$sessionCart) return;

        $userCart = Cart::firstOrCreate(['user_id' => $userId]);

        foreach ($sessionCart->items as $item) {
            $existingItem = $userCart->items()->where('product_id', $item->product_id)->first();

            if ($existingItem) {
                $existingItem->quantity += $item->quantity;
                $existingItem->price = $item->price; 
                $existingItem->save();
            } else {
                $userCart->items()->create([
                    'product_id' => $item->product_id,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                ]);
            }
        }

        $sessionCart->items()->delete();
        $sessionCart->delete();
    }
}
