@extends('layouts.admin')
@section('main-content')
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-fluid px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="package"></i></div>
                            Products List
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-outline-blue-soft text-primary"
                                href="{{ route('admin.product.add') }}">
                            <i class="me-1" data-feather="plus"></i>
                            Add New Product
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Filter -->
    <div class="container-fluid px-4 my-4">
        <form class="card p-3">
            @csrf
            <div class="container">
                <h3>Filter</h3>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="category">Category:</label>
                            <select class="form-select" id="category" name="category">
                                <option value="all">All</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- Brand -->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="author">Brand:</label>
                            <select class="form-select" id="brand" name="brand">
                                <option value="all">All</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : ''}}>{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="price">Price:</label>
                            <select class="form-select" id="price" name="price">
                                <option value="all">All</option>
                                <option value="1" {{ request('price') == 1 ? 'selected' : ''}}>Less than 10$</option>
                                <option value="2" {{ request('price') == 2 ? 'selected' : ''}}>From 10$ to 20$</option>
                                <option value="3" {{ request('price') == 3 ? 'selected' : ''}}>From 20$ to 30$</option>
                                <option value="4" {{ request('price') == 4 ? 'selected' : ''}}>From 30$ to 40$</option>
                                <option value="5" {{ request('price') == 5 ? 'selected' : ''}}>Over 40$</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button class="btn btn-primary" id="filterBtn" type="submit">Filter</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Main page content-->
    <div class="container-fluid px-4 pb-4">
        <div class="card">
            <div class="card-body">
                <table id="datatablesSimple" class="table table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Price</th>
                        <th>Sale_price</th>
                        <th>View</th>
                        <th>Total sold</th>
                        <th>Quantity</th>
                        <th>Rating</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Price</th>
                        <th>Sale_price</th>
                        <th>View</th>
                        <th>Total sold</th>
                        <th>Quantity</th>
                        <th>Rating</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>
                                @foreach($images as $image)
                                    @if($image->is_thumbnail == 1 && $image->product_id == $product->id)
                                        <img style="width: 32px; height: 16px" class="img-fluid pointer"
                                                src="{{ $image->path }}" alt="{{ $image->name }}" data-bs-toggle="modal"
                                                data-bs-target="{{ '#imageModal'.$product->id }}">
                                    @endif
                                @endforeach
                                <!-- Modal -->
                                <div class="modal fade " id="{{ 'imageModal'.$product->id }}" tabindex="-1"
                                        aria-labelledby="imageModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                        id="imageModalLabel">Image {{ $product->name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body d-flex justify-content-start align-items-center flex-wrap">
                                                @foreach($images as $image )
                                                    @if($image->product_id == $product->id)
                                                        <img src="{{ $image->path }}"
                                                                class="img-fluid w-25 h-25 mx-5 my-3"
                                                                alt="{{ $image->name }}">
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->brand->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->sale_price }}</td>
                            <td>{{ $product->view }}</td>
                            <td>{{ $product->total_sold }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->rating }}</td>
                            <td>
                                @if ($product->status === 1)
                                    <div class="badge bg-primary text-white rounded-pill">Show</div>
                                @else
                                    <div class="badge bg-light text-black rounded-pill">Hidden</div>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2"
                                        href="{{ route('admin.product.edit', ['id' => $product->id]) }}"><i
                                            data-feather="edit"></i></a>
                                <a class="btn btn-datatable btn-icon btn-transparent-dark"
                                        onclick="return confirm('Are you sure you want to delete this product?')"
                                        href="{{ route('admin.product.delete', ['id' => $product->id]) }}"><i
                                            data-feather="trash-2"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection