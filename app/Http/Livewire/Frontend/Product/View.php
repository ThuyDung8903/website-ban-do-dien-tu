<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class View extends Component
{
    public $category, $product;

    public function addToWishList($productId)
    {
        if(Auth::guard('customer')->check()) {
            // get user_id of logged in customer
            $userId = Auth::guard('customer')->user()->id;

            $check = Wishlist::where('user_id', $userId)->where('product_id', $productId)->first();
            if (!$check) {
                Wishlist::create([
                    'user_id' => $userId,
                    'product_id' => $productId,
                ]);
                session()->flash('success', 'Added to wishlist successfully');
            } else {
                session()->flash('message', 'Product already added to wishlist');
                return false;
            }
        } else {
            session()->flash('error', 'Please login to add product to wishlist');
            //return redirect()->route('customer.login');
            return false;
        }
    }

    public function mount($category, $product)
    {
        $this->category = $category;
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.frontend.product.view', [
            'category' => $this->category,
            'product' => $this->product,
        ]);
    }
}
