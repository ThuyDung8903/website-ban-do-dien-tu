@extends('layouts.app')

@section('title', 'Search Results')

@section('content')

    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <h4>Search results for <strong>"{{ $keyword }}"</strong></h4>
                    <div class="footer-underline mb-4"></div>
                </div>

                @forelse($searchProducts as $productItem)
                    <div class="col-md-10">
                        <div class="product-card">
                            <div class="row">
                                <div class="col-md-3">
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
                                </div>
                                <div class="col-md-9">
                                    <div class="product-card-body">
                                        <p class="product-brand">{{ $productItem->brands->name }}</p>
                                        <h5 class="product-name">
                                            <a href="{{ url('/collections/'.$productItem->category->slug.'/'.$productItem->slug) }}">
                                                {{ $productItem->name}}
                                            </a>
                                        </h5>
                                        <div>
                                            <span class="selling-price">${{ $productItem->sale_price }}</span>
                                            <span class="original-price">${{ $productItem->price }}</span>
                                        </div>
                                        <p style="height: 45px; overflow: hidden">
                                            <b>Description: </b>{{ $productItem->short_description }}
                                        </p>
                                        <a href="{{ url('/collections/'.$productItem->category->slug.'/'.$productItem->slug) }}"
                                           class="btn btn-sm btn-warning px-3">
                                            View details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12 p-2">
                        <div class="p-2">
                            <h4>No search result</h4>
                        </div>
                    </div>
                @endforelse

                <div class="col-md-10">
                    {{ $searchProducts->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
