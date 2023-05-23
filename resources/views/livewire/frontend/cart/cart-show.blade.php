<div class="py-3 py-md-5 bg-light">
    <div class="container">
        <h3 class="mb-3">My Shopping Cart</h3>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="shopping-cart">

                    <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                        <div class="row">
                            <div class="col-md-5">
                                <h4>Products</h4>
                            </div>
                            <div class="col-md-1">
                                <h4>Price</h4>
                            </div>
                            <div class="col-md-2">
                                <h4>Quantity</h4>
                            </div>
                            <div class="col-md-2">
                                <h4>Subtotal</h4>
                            </div>
                            <div class="col-md-2">
                                <h4>Remove</h4>
                            </div>
                        </div>
                    </div>

                    @forelse($cart as $cartItem)
                        @if($cartItem->product)
                            <div class="cart-item">
                                <div class="row">
                                    <div class="col-md-5 my-auto">
                                        <a href="{{ url('collections/'.$cartItem->product->category->slug.'/'.$cartItem->product->slug) }}">
                                            <label class="product-name">
                                                @if($cartItem->product->images)
                                                    <img src="{{ $cartItem->product->images[0]->path }}"
                                                         style="width: 50px; height: 50px"
                                                         alt="{{ $cartItem->product->name }}">
                                                @else
                                                    <img src="{{ asset('frontend/images/no-image.png') }}"
                                                         style="width: 50px; height: 50px"
                                                         alt="">
                                                @endif
                                                {{ $cartItem->product->name }}
                                            </label>
                                        </a>
                                    </div>
                                    <div class="col-md-1 my-auto">
                                        <label class="price">${{ $cartItem->product->sale_price }}</label>
                                    </div>
                                    <div class="col-md-2 col-7 my-auto">
                                        <div class="quantity">
                                            <div class="input-group">
                                                <button class="btn btn1" wire:loading.attr="disabled"
                                                      wire:click="decreaseQuantity({{ $cartItem->id }})"><i
                                                        class="fa fa-minus"></i></button>
                                                <input type="number" value="{{ $cartItem->quantity }}"
                                                       class="input-quantity"/>
                                                <button
                                                    class="btn btn1" wire:loading.attr="disabled"
                                                      wire:click="increaseQuantity({{ $cartItem->id }})"><i
                                                        class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 my-auto">
                                        <label class="price">${{ $cartItem->product->sale_price * $cartItem->quantity }}</label>
                                        @php $totalPrice += $cartItem->product->sale_price * $cartItem->quantity @endphp
                                    </div>
                                    <div class="col-md-2 col-5 my-auto">
                                        <div class="remove">
                                            <button type="button" class="btn btn-danger btn-sm" wire:loading.attr="disabled"
                                               wire:click.prevent="removeCartItem({{ $cartItem->id }})">
                                                <span wire:loading.remove wire:target="removeCartItem({{ $cartItem->id }})">
                                                    <i class="fa fa-trash"></i> Remove
                                                </span>
                                                <span wire:loading wire:target="removeCartItem({{ $cartItem->id }})">
                                                    <i class="fa fa-spinner fa-spin"></i> Removing...
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="cart-item">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="text-center">No Cart Items Available</h4>
                                </div>
                            </div>
                        </div>
                    @endforelse

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 my-md-auto mt-3">
                <h5>Continue shopping <a href="{{ url('/collections') }}">Click here</a></h5>
            </div>
            <div class="col-md-4 mt-3">
                <div class="shadow-sm bg-white p-3">
                    <h5>Total: <span class="float-end">${{ $totalPrice }}</span></h5>
                    <hr>
                    <div class="text-center">
                        <a href="{{ url('/checkout') }}" class="btn btn-warning w-100">Checkout</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
