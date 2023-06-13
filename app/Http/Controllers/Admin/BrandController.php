<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class BrandController extends Controller implements ICrud
{
    public function list(Request $request)
    {
        // TODO: Implement list() method.
        $brands = Brand::all();
        return view('admin.brand.list', compact('brands'));
    }

    public function add()
    {
        // TODO: Implement add() method.
        return view('admin.brand.add');
    }

    public function doAdd(Request $request)
    {
        // TODO: Implement doAdd() method.
        $validator = Validator::make($request->all(), [
            'image' => 'mimes:jpg,jpeg,png,gif',
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = new MessageBag($validator->errors()->all());
            return redirect()->back()->withErrors($errors)->withInput();
        }
        $data = $request->all();
        $file_name = $request->image->getClientOriginalName();
        $request->image->move(public_path('uploads/brands'), $file_name);
        $path = '/uploads/brands/' . $file_name;
        $data['image'] = $path;
        unset($data['_token']);
        try {
            Brand::create($data);
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
        return redirect()->back()->with('success', 'Add a new brand successfully');
    }

    public function edit($id)
    {
        // TODO: Implement edit() method.
        $obj = Brand::find($id);
        return view('admin.brand.edit', compact('obj'));
    }

    public function doEdit($id, Request $request)
    {
        // TODO: Implement doEdit() method.
        $validator = Validator::make($request->all(), [
            'image' => 'mimes:jpg,jpeg,png,gif',
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = new MessageBag($validator->errors()->all());
            return redirect()->back()->withErrors($errors)->withInput();
        }
        $data = $request->all();
        if($request->image != null){
            $file_name = $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/brands'), $file_name);
            $path = '/uploads/brands/' . $file_name;
            $data['image'] = $path;
        }
        unset($data['_token']);
        try {
            Brand::where('id', $id)->update($data);
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
        return redirect()->back()->with('success', 'Update brand successfully');
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
        $brand = Brand::findOrFail($id);
        foreach ($brand->products as $product) {
            $product->brand_id = null;
            $product->save();
        }
        $brand->delete();
        return redirect()->back()->with('success', 'Delete successfully');
    }
}