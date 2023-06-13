<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Brand;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $category, $brandInputs = [], $priceInput;
    protected $products;
    protected $queryString = [
        'brandInputs' => ['except' => '', 'as' => 'brand'],
        'priceInput' => ['except' => '', 'as' => 'price'],
    ];

    public function mount($category)
    {
        $this->category = $category;
    }

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

    public function addToCart(int $productId)
    {
        if (Auth::guard('customer')->check()) {
            //dd($productId);
            $product = Product::find($productId);
            $quantityCount = 1;
            if($product->where('id', $productId)->where('status', '1')->exists()) {
                //if product quantity is greater than 0: means product is In Stock
                if($product->quantity > 0) {
                    //if product quantity is less than quantityCount, not add to cart
                    if ($product->quantity < $quantityCount) {
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
                            'quantity' => $quantityCount,
                        ]);
                        $this->emit('cartAddedUpdated');
                        session()->flash('success', 'Added to cart successfully');
                        $this->dispatchBrowserEvent('message', [
                            'type' => 'success',
                            'message' => 'Added to cart successfully',
                            'status' => 200
                        ]);
                    } else {
                        //session()->flash('message', 'Already added to cart, update quantity from cart page
                        //update quantity in cart if already added this product to cart
                        $check->increment('quantity', $quantityCount);
                        $this->emit('cartCountUpdated');
                        $this->emit('cartAddedUpdated');
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

    public function render()
    {
        $this->products = $this->category->products()
            ->where('products.status', '1')
            ->when($this->brandInputs, function ($q) {
                $q->whereIn('brand_id', $this->brandInputs);
                $q->orWhereNull('brand_id')->where('status', '1')->where('category_id', $this->category->id);
            })
            ->when($this->priceInput, function ($q) {
                $q->when($this->priceInput == 'low-to-high', function ($q2) {
                    $q2->orderBy('sale_price', 'asc');
                })
                ->when($this->priceInput == 'high-to-low', function ($q2) {
                    $q2->orderBy('sale_price', 'desc');
                });
            })
            ->paginate(9);
        $this->brands = $this->category->brands()->distinct()->orderBy('name')->get();

        return view('livewire.frontend.product.index', [
            'products' => $this->products,
            'category' => $this->category,
            'brands' => $this->brands
        ]);
    }
}
