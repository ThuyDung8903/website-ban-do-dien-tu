@extends('layouts.admin')
@section('main-content')
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="edit"></i></div>
                            Edit Product
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-outline-blue-soft text-primary"
                                href="{{ route('admin.product.list') }}">
                            <i class="me-1" data-feather="arrow-left"></i>
                            Back to Products List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-4">
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h5 class="alert-heading">Alert!</h5>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button class="btn-close" type="button" data-bs-dismiss="alert"
                        aria-label="Close" aria-hidden="true"></button>
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <h5 class="alert-heading">Alert!</h5>
                {{ session('success') }}
                <button class="btn-close" type="button" data-bs-dismiss="alert"
                        aria-label="Close" aria-hidden="true"></button>
            </div>
        @endif
        <div class="row">
            <div class="col-xl-12">
                <!-- Product details card-->
                <div class="card mb-4">
                    <div class="card-header">Add Product</div>
                    <div class="card-body">
                        <form action="{{ route('admin.product.do-edit', ['id' => $obj->id]) }}" method="post"
                                enctype="multipart/form-data">
                            @csrf
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                            data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                            aria-selected="true">Home
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="seotag-tab" data-bs-toggle="tab"
                                            data-bs-target="#seotag" type="button" role="tab" aria-controls="seotag"
                                            aria-selected="false">SEO Tags
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="detail-tab" data-bs-toggle="tab"
                                            data-bs-target="#detail" type="button" role="tab" aria-controls="detail"
                                            aria-selected="false">Details
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="images-tab" data-bs-toggle="tab"
                                            data-bs-target="#images" type="button" role="tab" aria-controls="images"
                                            aria-selected="false">Images
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content mt-3" id="myTabContent">
                                <div class="tab-pane fade border p-3 show active" id="home" role="tabpanel"
                                        aria-labelledby="home-tab">
                                    <!-- Form Row-->
                                    <div class="row gx-3 mb-3">
                                        <!-- Form Group (name product)-->
                                        <div class="col-md-4">
                                            <label class="small mb-1" for="inputNameProduct">Product's name</label>
                                            <input class="form-control" id="inputNameProduct" name="name" type="text"
                                                    placeholder="Enter your product's name" value="{{ $obj->name }}"/>
                                        </div>
                                        <!-- Form Group (categories)-->
                                        <div class="col-md-4">
                                            <label class="small mb-1">Category</label>
                                            <select class="form-select" name="category_id"
                                                    aria-label="Default select example">
                                                <option selected disabled>Select a category:</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $obj->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!-- Form Group (brands)-->
                                        <div class="col-md-4">
                                            <label class="small mb-1">Brand</label>
                                            <select class="form-select" name="brand_id"
                                                    aria-label="Default select example">
                                                <option selected disabled>Select a brand:</option>
                                                @foreach($brands as $brand)
                                                    <option value="{{ $brand->id }}" {{ $obj->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="small mb-1" for="slug">Product Slug</label>
                                        <input class="form-control" id="slug" name="slug" type="text"
                                                placeholder="Enter slug" value="{{ $obj->slug }}"/>
                                    </div>
                                    <!-- Form Group (short_description)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="inputShortDescription">Short
                                            description</label>
                                        <textarea class="form-control" id="inputShortDescription"
                                                name="short_description" type="text" rows="4"
                                                placeholder="Enter short description">{{ $obj->short_description }}</textarea>
                                    </div>
                                    <!-- Form Group (detail_description)-->
                                    <div class="mb-3">
                                        <label class="small mb-1"
                                                for="inputDetailDescription">Detail Description</label>
                                        <textarea class="form-control" id="inputDetailDescription"
                                                name="detail_description"
                                                type="text" rows="10"
                                                placeholder="Enter detail_description">{{ $obj->detail_description }}</textarea>
                                    </div>
                                </div>
                                <div class="tab-pane fade border p-3" id="seotag" role="tabpanel"
                                        aria-labelledby="seotag-tab">
                                    <div class="row gx-3 mb-3">
                                        <!-- Form Group (meta_title)-->
                                        <div class="col-md-4">
                                            <label class="small mb-1" for="inputMetaTitle">Meta title</label>
                                            <input class="form-control" id="inputMetaTitle" name="meta_title"
                                                    type="text"
                                                    placeholder="Enter meta_title" value="{{ $obj->meta_title }}"/>
                                        </div>
                                        <!-- Form Group (meta_description)-->
                                        <div class="col-md-4">
                                            <label class="small mb-1" for="inputMetaDescription">Meta
                                                description</label>
                                            <input class="form-control" id="inputMetaDescription"
                                                    name="meta_description" type="text"
                                                    placeholder="Enter meta_description"
                                                    value="{{ $obj->meta_description }}"/>
                                        </div>
                                        <!-- Form Group (meta_keywords)-->
                                        <div class="col-md-4">
                                            <label class="small mb-1" for="inputMetaKeywords">Meta keywords</label>
                                            <input class="form-control" id="inputMetaKeywords" name="meta_keyword"
                                                    type="text"
                                                    placeholder="Enter meta_keywords"
                                                    value="{{ $obj->meta_keyword }}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade border p-3" id="detail" role="tabpanel"
                                        aria-labelledby="detail-tab">
                                    <div class="row gx-3 mb-3">
                                        <!-- Form Group (price)-->
                                        <div class="col-md-4">
                                            <label class="small mb-1" for="inputPrice">Price</label>
                                            <input class="form-control" id="inputPrice" name="price" type="text"
                                                    placeholder="Enter price" value="{{ $obj->price }}"/>
                                        </div>
                                        <!-- Form Group (sale_price)-->
                                        <div class="col-md-4">
                                            <label class="small mb-1" for="inputSalePrice">Sale price</label>
                                            <input class="form-control" id="inputSalePrice" name="sale_price"
                                                    type="text"
                                                    placeholder="Enter sale_price" value="{{ $obj->sale_price }}"/>
                                        </div>
                                        <!-- Form Group (quantity)-->
                                        <div class="col-md-4">
                                            <label class="small mb-1" for="inputQuantity">Quantity</label>
                                            <input class="form-control" id="inputQuantity" name="quantity" type="number"
                                                    placeholder="Enter quantity" value="{{ $obj->quantity }}"/>
                                        </div>
                                    </div>
                                    <div class="row gx-3 mb-3">
                                        <!-- Form Group (Status radio)-->
                                        <div class="col-md-3">
                                            <label for="status">Status</label>
                                            <div class="form-check form-check-solid">
                                                <input class="form-check-input" id="show" type="radio" name="status"
                                                        {{ $obj->status == 1 ? 'checked' : '' }} value="1">
                                                <label class="form-check-label" for="show">Show</label>
                                            </div>
                                            <div class="form-check form-check-solid">
                                                <input class="form-check-input" id="hidden" type="radio" name="status"
                                                        {{ $obj->status == 0 ? 'checked' : '' }} value="0">
                                                <label class="form-check-label" for="hidden">Hidden</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="trending">Trending</label>
                                            <div class="form-check form-check-solid">
                                                <input class="form-check-input" id="trend" type="radio"
                                                        name="trending"
                                                        {{ $obj->trending == 1 ? 'checked' : '' }} value="1">
                                                <label class="form-check-label" for="trend">Trending</label>
                                            </div>
                                            <div class="form-check form-check-solid">
                                                <input class="form-check-input" id="not_trending" type="radio"
                                                        name="trending"
                                                        {{ $obj->trending == 0 ? 'checked' : '' }}
                                                        value="0">
                                                <label class="form-check-label" for="not_trending">Not trending</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade border p-3 " id="images" role="tabpanel"
                                        aria-labelledby="images-tab">
                                    <div class="mb-3">
                                        <label for="is_thumbnail">Upload Thumbnail</label>
                                        <input class="form-control" type="file" name="is_thumbnail" id="is_thumbnail">
                                    </div>
                                    <div class="mb-3">
                                        <label for="path">Upload more product's images(Multiple files can be selected)</label>
                                        <input class="form-control" type="file" multiple name="path[]" id="path">
                                    </div>
                                    <div class="mb-3">
                                        @if($obj->images)
                                            <div class="row">
                                                @foreach( $obj->images->sortByDesc('is_thumbnail') as $image)
                                                    <div class="col-1 my-2">
                                                        @if($image->is_thumbnail == 1)
                                                            <div class="position-relative">
                                                                <img src="{{ asset($image->path) }}"
                                                                        alt="{{ $image->name }}"
                                                                        width="80px" height="80px" class=" border">
                                                                <span class="position-absolute top start-80 translate-middle badge border border-light rounded-circle bg-danger p-1">
                                                                    <span class="visually-hidden">is_thumbnail</span>
                                                                </span>
                                                            </div>
                                                        @else
                                                            <img src="{{ asset($image->path) }}"
                                                                    alt="{{ $image->name }}"
                                                                    width="80px" height="80px" class="me-4 border">
                                                            <a class="btn btn-datatable btn-icon btn-transparent-dark d-block mx-auto my-1"
                                                                    onclick="return confirm('Are you sure you want to delete this image?')"
                                                                    href="{{ route('admin.product.delete-image', ['id' => $image->id]) }}"><i
                                                                        data-feather="trash-2"></i></a>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- Submit button-->
                            <button class="btn btn-primary m-3 float-end" type="submit">Save change</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection