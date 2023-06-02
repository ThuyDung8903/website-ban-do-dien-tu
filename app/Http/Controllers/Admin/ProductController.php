<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller implements ICrud
{

    public function list(Request $request)
    {
        // TODO: Implement list() method.
        $categories = Category::all();
        $brands = Brand::all();
        $images = Image::all();
        $products = Product::with('category', 'brand', 'images');
        $request->except('_token');
        if ($request->category != 'all' && $request->has('category')) {
            $products->where('category_id', '=', $request->category);
        }
        if ($request->brand != 'all' && $request->has('brand')) {
            $products->where('brand_id', '=', $request->brand);
        }
        if ($request->price != 'all' && $request->has('price')) {
            if ($request->price == '1') {
                $products->where('price', '<', 10);
            } elseif ($request->price == '2') {
                $products->where('price', '>=', 10)->where('price', '<', 20);
            } elseif ($request->price == '3') {
                $products->where('price', '>=', 20)->where('price', '<', 30);
            } elseif ($request->price == '4') {
                $products->where('price', '>=', 30)->where('price', '<', 40);
            } elseif ($request->price == '5') {
                $products->where('price', '>=', 40);
            }
        }
        $products = $products->get();
        return view('admin.product.list', compact('products', 'categories', 'brands', 'images'));
    }

    public function add()
    {
        $categories = Category::all();
        $brands = Brand::all();
        // TODO: Implement add() method.
        return view('admin.product.add', compact('categories', 'brands'));
    }

    public function doAdd(Request $request)
    {
        // TODO: Implement doAdd() method.
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products|max:255',
            'price' => 'required|numeric',
            'sale_price' => 'required|numeric|lte:price',
            'category_id' => 'required',
            'brand_id' => 'required',
            'is_thumbnail' => 'required|mimes:jpg,jpeg,png,gif',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = $request->all();
        unset($data['_token']);
        $category = Category::findOrFail($request->category_id);
        $data['slug'] = Str::slug($data['slug']);
        $product = $category->products()->create($data);
        if ($request->hasFile('is_thumbnail')) {
            $file = $request->file('is_thumbnail');
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('uploads/products'), $file_name);
            $path = '/uploads/products/' . $file_name;
            Image::create([
                'name' => Str::before($file_name, '.'),
                'path' => $path,
                'product_id' => $product->id,
                'is_thumbnail' => '1',
            ]);
        }
        if ($request->hasFile('path')) {
            foreach ($request->file('path') as $image) {
                $file_name = $image->getClientOriginalName();
                $image->move(public_path('uploads/products'), $file_name);
                $path = '/uploads/products/' . $file_name;
                Image::create([
                    'name' => Str::before($file_name, '.'),
                    'path' => $path,
                    'product_id' => $product->id,
                    'is_thumbnail' => '0',
                ]);
            }
        }
        return redirect()->back()->with('success', 'Add product successfully!');
    }

    public function edit($id)
    {
        // TODO: Implement edit() method.
        $obj = Product::findOrFail($id);
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.product.edit', compact('obj', 'categories', 'brands'));
    }

    public function doEdit($id, Request $request)
    {
        // TODO: Implement doEdit() method.
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'sale_price' => 'required|numeric|lte:price',
            'is_thumbnail' => 'mimes:jpg,jpeg,png,gif',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = $request->all();
        unset($data['_token']);
        $data['slug'] = Str::slug($data['slug']);
        $product = Category::findOrFail($data['category_id'])->products()->where('id', $id)->first();
        $product->update($data);
        if ($request->hasFile('is_thumbnail')) {
            $file = $request->file('is_thumbnail');
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('uploads/products'), $file_name);
            $path = '/uploads/products/' . $file_name;
            $image_thumbnail = Image::where('product_id', $product->id)->where('is_thumbnail', 1)->first();
            if ($image_thumbnail) {
                $image_thumbnail->name = Str::before($file_name, '.');
                $image_thumbnail->path = $path;
                $image_thumbnail->save();
            } else {
                Image::create([
                    'name' => Str::before($file_name, '.'),
                    'path' => $path,
                    'product_id' => $product->id,
                    'is_thumbnail' => '1',
                ]);
            }
        }
        if ($request->hasFile('path')) {
            foreach ($request->file('path') as $image) {
                $file_name = $image->getClientOriginalName();
                $image->move(public_path('uploads/products'), $file_name);
                $path = '/uploads/products/' . $file_name;
                Image::create([
                    'name' => Str::before($file_name, '.'),
                    'path' => $path,
                    'product_id' => $product->id,
                    'is_thumbnail' => '0',
                ]);
            }
        }
        return redirect()->back()->with('success', 'Edit product successfully!');
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
        Product::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Delete product successfully!');
    }

    public function deleteImage($image_id)
    {
        $image = Image::findOrFail($image_id);
        if (File::exists($image->path)) {
            File::delete($image->path);
        }
        $image->delete();
        return redirect()->back()->with('success', 'Delete image successfully!');
    }

    public function view_detail()
    {
        return view('admin.product.view-detail');
    }
}