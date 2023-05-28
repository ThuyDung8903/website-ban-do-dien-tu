<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Livewire\Component;

class CheckoutShow extends Component
{
    public $carts, $totalProductAmount = 0;

    public $name, $phone, $email, $address, $shipping_zip_code, $payment_method_id, $shipping_method_id, $payment_mode = NULL, $payment_id = NULL;

    public function __construct()
    {
        $this->carts = Cart::where('user_id', auth()->guard('customer')->user()->id)->get();
        foreach ($this->carts as $cart) {
            $this->totalProductAmount += $cart->product->sale_price * $cart->quantity;
        }
        $this->name = auth()->guard('customer')->user()->fullname;
        $this->phone = auth()->guard('customer')->user()->phone;
        $this->email = auth()->guard('customer')->user()->email;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|regex:/^[0-9]{10,11}$/',
            'email' => 'required|email',
            'address' => 'required|string|max:500',
            'shipping_zip_code' => 'nullable|digits:5',
        ];
    }

    public function updated($field)
    {
        $this->resetErrorBag();
        $this->validateOnly($field);
    }
    public function placeOrder()
    {
        $validatedData = $this->validate();
        if (!$validatedData) {
            // Xử lý khi validation không thành công
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        $order = Order::create([
            'customer_id' => auth()->guard('customer')->user()->id,
            'order_status_id' => 1,
            'payment_method_id' => $this->payment_method_id,
            'shipping_method_id' => $this->shipping_method_id,
            'customer_name' => $this->name,
            'customer_phone' => $this->phone,
            'customer_email' => $this->email,
            'customer_address' => $this->address,
            'shipping_name' => $this->name,
            'shipping_phone' => $this->phone,
            'shipping_email' => $this->email,
            'shipping_address' => $this->address,
            'shipping_zip_code' => $this->shipping_zip_code,
            'tax_price' => 0,
            'customer_shipping_price' => 0,
            'customer_payment_price' => $this->totalProductAmount,
            'total_price' => $this->totalProductAmount,
            'total_bill' => $this->totalProductAmount,
            'tracking_number' => 'EMS'.rand(1000000, 9999999),
            'payment_mode' => '1',
            'payment_id' => $this->payment_id,
        ]);


        foreach ($this->carts as $cartItem) {
            $orderItems = OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'product_name' => $cartItem->product->name,
                'product_price' => $cartItem->product->sale_price,
                'product_image' => ($cartItem->product->image)? $cartItem->product->image[0]->path : null,
//                'product_color' => $cartItem->product->color,
//                'product_size' => $cartItem->product->size,
                'quantity' => $cartItem->quantity,
            ]);
        }
        return true;
    }
    public function codOrder()
    {
        $this->shipping_method_id = 1;
        $this->payment_method_id = 1;
        $this->payment_mode = 'Cash On Delivery';
        $codOrder = $this->placeOrder();
        if($codOrder) {
            //reset cart
            $this->resetCart();
            $this->dispatchBrowserEvent('message', [
                'type' => 'success',
                'message' => 'Order Placed Successfully!',
                'status' => '200'
            ]);
            return redirect()->to('thank-you');
        } else {
            $this->dispatchBrowserEvent('message', [
                'type' => 'error',
                'message' => 'Something went wrong! Please try again',
                'status' => '500'
            ]);
        }
    }

    public function resetCart()
    {
        Cart::where('user_id', auth()->guard('customer')->user()->id)->delete();
        $this->totalProductAmount = 0;
    }
    public function totalProductAmount()
    {
        $this->carts = Cart::where('user_id', auth()->guard('customer')->user()->id)->get();
        foreach ($this->carts as $cartItem) {
            $this->totalProductAmount += $cartItem->product->sale_price * $cartItem->quantity;
        }
        return $this->totalProductAmount;

    }

    public function render()
    {
        //$this->totalProductAmount = $this->totalProductAmount();
//        $this->name = auth()->guard('customer')->user()->fullname;
//        $this->phone = auth()->guard('customer')->user()->phone;
//        $this->email = auth()->guard('customer')->user()->email;
        return view('livewire.frontend.checkout.checkout-show', [
            'carts' => $this->carts,
            'totalProductAmount' => $this->totalProductAmount,
        ]);
    }
}
