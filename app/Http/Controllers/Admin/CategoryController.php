<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Str;

class CategoryController extends Controller implements ICrud
{
    public function list(Request $request)
    {
        // TODO: Implement list() method.
        $search = $request->search;
        if ($search) {
            $categories = Category::where('name', 'like', '%' . $search . '%')->get();
        } else {
            $categories = Category::all();
        }
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
        $validator = Validator::make($request->all(), [
            'image' => 'mimes:jpg,jpeg,png,gif',
            'name' => 'required',
        ], [
            'image.mimes' => 'Allowed file formats are: jpg, jpeg ,png, gif',
            'name.required' => 'Category name cannot be empty',
        ]);

        if ($validator->fails()) {
            $errors = new MessageBag($validator->errors()->all());
            return redirect()->back()->withErrors($errors)->withInput();
        }

        $data = $request->except('parent_id', 'image');
        if ($request->image != null) {
            $file_name = $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/categories'), $file_name);
            $path = '/uploads/categories/' . $file_name;
            $data['image'] = $path;
        }

        if ($request->parent_id == 0) {
            $data['parent_id'] = null;
        } else {
            $data['parent_id'] = $request->parent_id;
        }
        $data['slug'] = Str::slug($request->name);
        unset($data['_token']);
        try {
            Category::create($data);
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
        return redirect()->back()->with('success', 'Add a new category successfully');
    }

    public function edit($id)
    {
        // TODO: Implement edit() method.
        $obj = Category::find($id);
        $categories = Category::all();
        return view('admin.category.edit', compact('obj', 'categories'));
    }

    public function doEdit($id, Request $request)
    {
        // TODO: Implement doEdit() method.
        $data = $request->except('parent_id', 'image');
        if ($request->image != null) {
            $file_name = $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/categories'), $file_name);
            $path = '/uploads/categories/' . $file_name;
            $data['image'] = $path;
        }

        if ($request->parent_id == 0) {
            $data['parent_id'] = null;
        } else {
            $data['parent_id'] = $request->parent_id;
        }
        $data['slug'] = Str::slug($request->name);
        unset($data['_token']);
        try {
            Category::where('id', $id)->update($data);
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
        return redirect()->back()->with('success', 'Update successfully!');
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
        $category = Category::findOrFail($id);
        foreach ($category->products as $product) {
            $product->category_id = null;
            $product->save();
        }
        $category->delete();
        return redirect()->back()->with('success', 'Delete successfully');
    }
}