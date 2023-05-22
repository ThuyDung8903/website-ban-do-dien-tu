<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class View extends Component
{
    public $category, $product, $quantityCount = 1;

    public function addToWishList($productId)
    {
        if (Auth::guard('customer')->check()) {
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

    public function decrementQuantity()
    {
        if ($this->quantityCount > 1) {
            $this->quantityCount--;
        }
    }

    public function incrementQuantity()
    {
        if ($this->quantityCount < $this->product->quantity) {
            $this->quantityCount++;
        } else {
            $this->dispatchBrowserEvent('message', [
                'type' => 'warning',
                'message' => 'You have reached the maximum quantity available for this product',
                'status' => 200
            ]);
        }
    }

    public function addToCart(int $productId)
    {
        if (Auth::guard('customer')->check()) {
            //dd($productId);
            if($this->product->where('id', $productId)->where('status', '1')->exists()) {
                //if product quantity is greater than 0: means product is In Stock
                if($this->product->quantity > 0) {
                    //if product quantity is less than quantityCount, not add to cart
                    if ($this->product->quantity < $this->quantityCount) {
                        $this->dispatchBrowserEvent('message', [
                            'type' => 'warning',
                            'message' => 'You have reached the maximum quantity available for this product: ' .$this->product->quantity,
                            'status' => 200
                        ]);
                        return false;
                    }
                    // insert product into cart, and save to carts table
                    // get user_id of logged in customer
                    $userId = Auth::guard('customer')->user()->id;
                    $check = Cart::where('user_id', $userId)->where('product_id', $productId)->first();
                    if (!$check) {
                        Cart::create([
                            'user_id' => $userId,
                            'product_id' => $productId,
                            'quantity' => $this->quantityCount,
                        ]);
                        $this->emit('cartCountUpdated');
                        //session()->flash('success', 'Added to cart successfully');
                        $this->dispatchBrowserEvent('message', [
                            'type' => 'success',
                            'message' => 'Added to cart successfully',
                            'status' => 200
                        ]);
                    } else {
                        //session()->flash('message', 'Already added to cart, update quantity from cart page
                        //update quantity in cart if already added this product to cart
                        $check->increment('quantity', $this->quantityCount);
                        $this->emit('cartCountUpdated');
                        $this->dispatchBrowserEvent('message', [
                            'type' => 'warning',
                            'message' => 'Already added to cart and Updated quantity',
                            'status' => 401
                        ]);
                        return false;
                    }
                }
            }
            else {
                $this->dispatchBrowserEvent('message', [
                    'type' => 'warning',
                    'message' => 'This product is not available',
                    'status' => 200
                ]);
                return false;
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'type' => 'info',
                'message' => 'Please login to add product to cart',
                'status' => 401
            ]);
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
