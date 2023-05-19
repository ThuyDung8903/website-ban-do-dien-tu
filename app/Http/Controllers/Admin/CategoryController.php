<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller implements ICrud
{
    public function list(Request $request)
    {
        // TODO: Implement list() method.
//        $perPage = $request->input('per_page', 10);
        $categories = Category::all();
        return view('admin.category.list', compact('categories'));
    }

    public function add()
    {
        // TODO: Implement add() method.
        $categories = Category::all();
        return view('admin.category.add', compact('categories'));
    }

    public function doAdd(Request $request)
    {
        // TODO: Implement doAdd() method.
    }

    public function edit($id)
    {
        // TODO: Implement edit() method.
    }

    public function doEdit($id, Request $request)
    {
        // TODO: Implement doEdit() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}