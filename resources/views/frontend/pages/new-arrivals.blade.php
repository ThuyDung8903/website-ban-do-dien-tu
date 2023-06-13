@extends('layouts.app')

@section('title', 'New Arrivals')

@section('content')

    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>New Arrivals</h4>
                    <hr/>
                </div>

                @forelse($newArrivalsProducts as $productItem)
                    <div class="col-md-3">
                        <div class="product-card">
                            <div class="product-card-img">
                                <label class="stock bg-danger">New</label>
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
                @empty
                    <div class="col-md-12 p-2">
                        <div class="p-2">
                            <h4>No Products Available</h4>
                        </div>
                    </div>
                @endforelse

{{--                <div class="text-center">--}}
{{--                    {{ $newArrivalsProducts->links() }}--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
@endsection
