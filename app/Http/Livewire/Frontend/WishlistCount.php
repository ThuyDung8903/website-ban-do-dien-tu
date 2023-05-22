<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Wishlist;
use Livewire\Component;

class WishlistCount extends Component
{

    public int $wishlistCount;

    protected $listeners = [
        'wishlistCountUpdated' => 'checkWishlistCount'
    ];

    public function checkWishlistCount()
    {
        if(auth()->guard('customer')->check()) {
            return $this->wishlistCount = Wishlist::where('user_id', auth()->guard('customer')->user()->id)->count();
        } else {
            return $this->wishlistCount = 0;
        }
    }

    public function render()
    {
        $this->wishlistCount =  $this->checkWishlistCount();
        return view('livewire.frontend.wishlist-count', [
            'wishlistCount' => $this->wishlistCount
        ]);
    }
}
