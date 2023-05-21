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
                $this->emit('wishlistCountUpdated');
                //session()->flash('success', 'Added to wishlist successfully');
                $this->dispatchBrowserEvent('message', [
                    'type' => 'success',
                    'message' => 'Added to wishlist successfully',
                    'status' => 200
                ]);
            } else {
                //session()->flash('message', 'Already added to wishlist');
                $this->dispatchBrowserEvent('message', [
                    'type' => 'warning',
                    'message' => 'Already added to wishlist',
                    'status' => 200
                ]);
                return false;
            }
        } else {
            //session()->flash('error', 'Please login to add product to wishlist');
            $this->dispatchBrowserEvent('message', [
                'type' => 'info',
                'message' => 'Please login to add product to wishlist',
                'status' => 401
            ]);
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
