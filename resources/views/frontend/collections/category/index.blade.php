@extends('layouts.app')

@section('title', 'All Categories')

@section('content')
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="mb-4">Our Categories</h4>
                </div>
                @forelse($categories as $categoryItem)
                <div class="col-6 col-md-3">
                    <div class="category-card">
                        <a href="">
                            <div class="category-card-img">
                                <img src="{{ $categoryItem->image }}" class="w-100" alt="Mobile Devices">
                            </div>
                            <div class="category-card-body">
                                <h5>{{ $categoryItem->name }}</h5>
                            </div>
                        </a>
                    </div>
                </div>
                @empty
                    <div class="col-md-12">
                        <h5>No Categories Available</h5>
                    </div>
                @endforelse

{{--                <div class="col-6 col-md-3">--}}
{{--                    <div class="category-card">--}}
{{--                        <a href="">--}}
{{--                            <div class="category-card-img">--}}
{{--                                <img src="https://www.tldevtech.com/wp-content/uploads/tdt/2019/11/New-Apple-MacBook-Pro.jpg" class="w-100" alt="Laptop">--}}
{{--                            </div>--}}
{{--                            <div class="category-card-body">--}}
{{--                                <h5>Laptop</h5>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-6 col-md-3">--}}
{{--                    <div class="category-card">--}}
{{--                        <a href="">--}}
{{--                            <div class="category-card-img">--}}
{{--                                <img src="https://mobilepricespakistan.com.pk/wp-content/uploads/2020/03/realme-6-425x425.jpg" class="w-100" alt="Mobile Devices">--}}
{{--                            </div>--}}
{{--                            <div class="category-card-body">--}}
{{--                                <h5>Mobile</h5>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-6 col-md-3">--}}
{{--                    <div class="category-card">--}}
{{--                        <a href="">--}}
{{--                            <div class="category-card-img">--}}
{{--                                <img src="https://aristino.com/Data/ResizeImage/images/product/so-mi-ngan-tay/ass085s9/ao-so-mi-nam-aristino-ASS085S9x900x900x4.webp" class="w-100" alt="Mens Fashion">--}}
{{--                            </div>--}}
{{--                            <div class="category-card-body">--}}
{{--                                <h5>Mens Fashion</h5>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-6 col-md-3">--}}
{{--                    <div class="category-card">--}}
{{--                        <a href="">--}}
{{--                            <div class="category-card-img">--}}
{{--                                <img src="https://www.luxurylifestylemag.co.uk/wp-content/uploads/2019/07/bigstock-Portrait-Of-Fashion-Young-Woma-295881097.jpg" class="w-100" alt="Women Fashion">--}}
{{--                            </div>--}}
{{--                            <div class="category-card-body">--}}
{{--                                <h5>Women Fashion</h5>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>


@endsection
