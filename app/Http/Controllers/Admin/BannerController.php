<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class BannerController extends Controller implements ICrud
{

    public function list(Request $request)
    {
        // TODO: Implement list() method.
        $banners = Banner::all();
        return view('admin.banner.list', compact('banners'));
    }

    public function add()
    {
        // TODO: Implement add() method.
        return view('admin.banner.add');
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
        $request->image->move(public_path('uploads/banners'), $file_name);
        $path = '/uploads/banners/' . $file_name;
        $data['image'] = $path;
        unset($data['_token']);
        try {
            Banner::create($data);
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
        return redirect()->back()->with('success', 'Add a new banner successfully');
    }

    public function edit($id)
    {
        // TODO: Implement edit() method.
        $obj = Banner::find($id);
        return view('admin.banner.edit', compact('obj'));
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
            $request->image->move(public_path('uploads/banners'), $file_name);
            $path = '/uploads/banners/' . $file_name;
            $data['image'] = $path;
        }
        unset($data['_token']);
        try {
            Banner::where('id', $id)->update($data);
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
        return redirect()->back()->with('success', 'Update banner successfully');
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
        Banner::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Delete successfully');
    }
}