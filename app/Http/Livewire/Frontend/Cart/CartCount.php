<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;

class CartCount extends Component
{
    public int $cartCount;

    protected $listeners = [
        'cartAddedUpdated' => 'checkCartCount',
        'cartCountUpdated' => 'checkCartCount',
    ];

    public function checkCartCount()
    {
        if(auth()->guard('customer')->check()){
            return $this->cartCount = Cart::where('user_id', auth()->guard('customer')->user()->id)->count();
        } else {
            return $this->cartCount = 0;
        }
    }
    public function render()
    {
        $this->cartCount = $this->checkCartCount();
        return view('livewire.frontend.cart.cart-count', [
            'cartCount' => $this->cartCount,
        ]);
    }
}
