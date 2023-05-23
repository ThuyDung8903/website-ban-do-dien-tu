<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;

class CartShow extends Component
{
    public $cart;

    protected $listeners = [
        'cartAdded' => 'render',
        'cartUpdated' => 'render',
        'cartDeleted' => 'render',
        'cartAddedUpdated' => 'render',
    ];

    public function mount()
    {
        $this->cart = Cart::where('user_id', auth()->guard('customer')->user()->id)->get();
    }

    public function decreaseQuantity($cartId)
    {
        $cartItem = Cart::find($cartId);
        if($cartItem) {
            // if quantity is 1 then delete the cart item (commented for now to now allow deleting cart item)
//            if($cartItem->quantity == 1) {
//                $cartItem->delete();
//                $this->emit('cartDeleted');
//                return;
//            }
            if ($cartItem->quantity > 1) {
                $cartItem->quantity = $cartItem->quantity - 1;
                $cartItem->save();
                $this->emit('cartAddedUpdated');
                $this->dispatchBrowserEvent('message', [
                    'type' => 'success',
                    'message' => 'Cart updated successfully',
                    'status' => 200
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'type' => 'error',
                'message' => 'Something went wrong! Cart item not found',
                'status' => 404
            ]);
            return;
        }

    }

    public function increaseQuantity($cartId)
    {
        $cartItem = Cart::find($cartId);
        if($cartItem) {
            if($cartItem->quantity < $cartItem->product->quantity) {
                $cartItem->quantity = $cartItem->quantity + 1;
                $cartItem->save();
                $this->emit('cartAddedUpdated');
                $this->dispatchBrowserEvent('message', [
                    'type' => 'success',
                    'message' => 'Cart updated successfully',
                    'status' => 200
                ]);
            } else {
                $this->dispatchBrowserEvent('message', [
                    'type' => 'error',
                    'message' => 'Something went wrong! Product quantity is not available',
                    'status' => 404
                ]);
                return;
            }
        }
    }

    public function removeCartItem($cartId)
    {
        $cartItem = Cart::find($cartId);
        if($cartItem) {
            $cartItem->delete();
            $this->emit('cartDeleted');
            $this->dispatchBrowserEvent('message', [
                'type' => 'success',
                'message' => 'Cart item deleted successfully',
                'status' => 200
            ]);
        } else {
            $this->dispatchBrowserEvent('message', [
                'type' => 'error',
                'message' => 'Wrong! Cart item not found',
                'status' => 404
            ]);
            return;
        }
    }
    public function render()
    {
        $this->cart = Cart::where('user_id', auth()->guard('customer')->user()->id)->get();
        return view('livewire.frontend.cart.cart-show', [
            'cart' => $this->cart,
        ]);
    }
}
