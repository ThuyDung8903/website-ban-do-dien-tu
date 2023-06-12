<div>
    <div class="py-3 py-md-5">
        <div class="container">
            @if(session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif(session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif(session()->has('warning'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row">
                <div class="col-md-5 mt-3">
                    <div class="bg-white border" wire:ignore>
                        @if ($product->images)
                            {{--                            <img src="{{ $product->images[0]->path }}" class="w-100" alt="{{ $product->slug }}">--}}
                            <div class="exzoom" id="exzoom">
                                <!-- Images -->
                                <div class="exzoom_img_box">
                                    <ul class='exzoom_img_ul'>
                                        @foreach($product->images as $image)
                                            <li><img src="{{ asset($image->path) }}"/></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- <a href="https://www.jqueryscript.net/tags.php?/Thumbnail/">Thumbnail</a> Nav-->
                                <div class="exzoom_nav"></div>
                                <!-- Nav Buttons -->
                                <p class="exzoom_btn">
                                    <a href="javascript:void(0);" class="exzoom_prev_btn"> < </a>
                                    <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                                </p>
                            </div>
                        @else
                            No Image Found
                        @endif
                    </div>
                </div>
                <div class="col-md-7 mt-3">
                    <div class="product-view">
                        <h4 class="product-name">
                            {{ $product->name }}
                        </h4>
                        <hr>
                        <p class="product-path">
                            <a class="link-dark" href="{{ url('/') }}">Home</a>/
                            <a href="{{ url('/collections/'.$category->slug) }}"> {{ $product->categories->name }} </a>
                            / {{ $product->name }}
                        </p>
                        <p class="product-brand">
                            Brand: <span class="text-primary">{{ $product->brands->name ?? 'No brand' }}</span>
                        </p>
                        <div>
                            <span class="selling-price">${{ $product->sale_price }}</span>
                            <span class="original-price">${{ $product->price }}</span>
                        </div>
                        <div>
                            @if ($product->quantity > 0)
                                <label class="btn-sm py-1 mt-2 text-white bg-success">In Stock</label>
                            @else
                                <label class="btn-sm py-1 mt-2 text-white bg-danger">Out of Stock</label>
                            @endif
                        </div>
                        <div class="mt-2">
                            <div class="input-group">
                                <span class="btn btn1" wire:click="decrementQuantity"><i class="fa fa-minus"></i></span>
                                <input type="text" wire:model="quantityCount" value="{{ $this->quantityCount }}"
                                       class="input-quantity"/>
                                <span class="btn btn1" wire:click="incrementQuantity"><i class="fa fa-plus"></i></span>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="button" wire:click="addToCart({{ $product->id }})" class="btn btn1"><i
                                    class="fa fa-shopping-cart"></i> Add To Cart
                            </button>
                            <button type="button" wire:click="addToWishList({{ $product->id }})" class="btn btn1">
                                <span wire:loading.remove wire:target="addToWishList">
                                    <i class="fa fa-heart"></i> Add To Wishlist
                                </span>
                                <span wire:loading wire:target="addToWishList">
                                    <i class="fa fa-spinner fa-spin"></i> Adding To Wishlist...
                                </span>
                            </button>
                        </div>
                        <div class="mt-3">
                            <h5 class="mb-0">Short Description</h5>
                            <p>
                                {{ $product->short_description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h4>Description</h4>
                        </div>
                        <div class="card-body">
                            <p>
                                {{ $product->detail_description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--    Related Products in this category--}}
    <div class="py-3 py-md-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h4 class="mb-3">
                        Related
                        @if($category)
                            {{ $category->name }}
                        @endif
                        Products
                    </h4>
                    <div class="footer-underline"></div>
                </div>
                <div class="col-md-12">
                    @if($category)
                        <div class="owl-carousel owl-theme trending-product four-carousel">
                            @foreach($category->relatedProducts as $productItem)
                                <div class="item mb-3">
                                    <div class="product-card">
                                        <div class="product-card-img">
                                            @if ($productItem->quantity > 0)
                                                <label class="stock bg-success">In Stock</label>
                                            @else
                                                <label class="stock bg-danger">Out of Stock</label>
                                            @endif
                                            @if ($productItem->images->count() > 0)
                                                <a href="{{ url('/collections/'.$productItem->category->slug.'/'.$productItem->slug) }}">
                                                    <img src="{{ $productItem->images[0]->path }}"
                                                         alt="{{ $productItem->name}}">
                                                </a>
                                            @endif

                                        </div>
                                        <div class="product-card-body">
                                            <p class="product-brand">{{ $productItem->brands->name ?? 'No brand' }}</p>
                                            <h5 class="product-name">
                                                <a href="{{ url('/collections/'.$productItem->category->slug.'/'.$productItem->slug) }}">
                                                    {{ $productItem->name}}
                                                </a>
                                            </h5>
                                            <div>
                                                <span class="selling-price">${{ $productItem->sale_price }}</span>
                                                <span class="original-price">${{ $productItem->price }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="col-md-12 p-2">
                            <div class="p-2">
                                <h4>No Related Products Available</h4>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>

{{--    Related Products have the same brand name--}}
@if($product->brands)
    <div class="py-3 py-md-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h4 class="mb-3">
                        Related Brand
                        {{ $product->brands->name}}
                        Products
                    </h4>
                    <div class="footer-underline"></div>
                </div>
                @if($product->brands)
                    <div class="col-md-12">
                        <div class="owl-carousel owl-theme trending-product four-carousel">
                            @foreach($category->relatedProducts as $productItem)
                                @if($productItem->brands == $product->brands)
                                    <div class="item mb-3">
                                        <div class="product-card">
                                            <div class="product-card-img">
                                                @if ($productItem->quantity > 0)
                                                    <label class="stock bg-success">In Stock</label>
                                                @else
                                                    <label class="stock bg-danger">Out of Stock</label>
                                                @endif
                                                @if ($productItem->images->count() > 0)
                                                    <a href="{{ url('/collections/'.$productItem->category->slug.'/'.$productItem->slug) }}">
                                                        <img src="{{ $productItem->images[0]->path }}"
                                                             alt="{{ $productItem->name}}">
                                                    </a>
                                                @endif

                                            </div>
                                            <div class="product-card-body">
                                                <p class="product-brand">{{ $productItem->brands->name ?? 'No brand' }}</p>
                                                <h5 class="product-name">
                                                    <a href="{{ url('/collections/'.$productItem->category->slug.'/'.$productItem->slug) }}">
                                                        {{ $productItem->name}}
                                                    </a>
                                                </h5>
                                                <div>
                                                    <span class="selling-price">${{ $productItem->sale_price }}</span>
                                                    <span class="original-price">${{ $productItem->price }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        @else
                            <div class="col-md-12 p-2">
                                <div class="p-2">
                                    <h4>No Related Products Available</h4>
                                </div>
                            </div>
                        @endif
                    </div>
            </div>

        </div>
        @endif
        @push('scripts')
            <script>
                $(function () {

                    $("#exzoom").exzoom({

                        // thumbnail nav options
                        "navWidth": 60,
                        "navHeight": 60,
                        "navItemNum": 5,
                        "navItemMargin": 7,
                        "navBorder": 1,

                        // autoplay
                        "autoPlay": false,

                        // autoplay interval in milliseconds
                        "autoPlayTimeout": 2000,
                    });

                });

                $('.four-carousel').owlCarousel({
                    loop: false,
                    margin: 10,
                    dots: true,
                    nav: false,
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 3
                        },
                        1000: {
                            items: 4
                        }
                    }
                })
            </script>
    @endpush
