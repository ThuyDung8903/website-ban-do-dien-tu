@php use Illuminate\Support\Str; @endphp
@extends('layouts.admin')
@section('main-content')
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="filter"></i></div>
                            Category
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header d-flex bd-highlight justify-content-md-between">
                <div class="p-2 bd-highlight">Extended DataTables</div>
                <a href="{{ route('admin.category.add') }}"
                        class="btn btn-blue text-white p-2 flex-shrink-1 bd-highlight">Add category <i
                            data-feather="plus-circle" class="fs-5"></i></a>
            </div>

            <div class="card-body">
                <table id="datatablesSimple" class="table table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Parent_category</th>
                        <th>Slug</th>
                        <th>Image</th>
                        <th>Desciption</th>
                        <th>Meta_description</th>
                        <th>Meta_title</th>
                        <th>Meta_words</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Parent_category</th>
                        <th>Slug</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Meta_description</th>
                        <th>Meta_title</th>
                        <th>Meta_words</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                @foreach($categories as $category1)
                                    @if($category->parent_id === $category1->id)
                                        {{ $category1->name }}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $category->slug }}</td>
                            <td>
                                <img src="{{url('/')}}{{ $category->image }}" alt="{{ $category->name }}" width="36px"
                                        height="36px">
                            </td>
                            <td>{{ Str::limit($category->description, 15, '...')  }}</td>
                            <td>{{ Str::limit($category->meta_description, 15, '...') }}</td>
                            <td>{{ Str::limit($category->meta_title, 15, '...') }}</td>
                            <td>{{ Str::limit($category->meta_keywords, 15, '...') }}</td>
                            <td>
                                @if ($category->status === 1)
                                    <div class="badge bg-primary text-white rounded-pill">Show</div>
                                @else
                                    <div class="badge bg-light text-black rounded-pill">Hidden</div>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2"
                                        href="{{ route('admin.category.edit', ['id'=>$category->id]) }}"><i
                                            data-feather="edit"></i></a>
                                <a class="btn btn-datatable btn-icon btn-transparent-dark"
                                        onclick="return confirm('Are you sure?')"
                                        href="{{ route('admin.category.delete', ['id' => $category->id]) }}"><i
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