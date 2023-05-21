<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Wishlist;
use Livewire\Component;

class WishlistShow extends Component
{

    public function removeWishlistItem(int $id)
    {
        $wishlist = Wishlist::findOrFail($id);
        $wishlist->delete();
        session()->flash('success', 'Item removed from wishlist successfully.');
        $this->dispatchBrowserEvent('message', [
            'type' => 'success',
            'message' => 'Item removed from wishlist successfully.',
            'status' => 200
        ]);
    }
    public function render()
    {
        $wishlists = Wishlist::where('user_id', auth()->guard('customer')->user()->id)->get();
        return view('livewire.frontend.wishlist-show', [
            'wishlists' => $wishlists
        ]);
    }
}
