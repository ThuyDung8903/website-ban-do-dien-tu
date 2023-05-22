<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller implements ICrud
{
    public function list(Request $request)
    {
        // TODO: Implement list() method.
        $users = User::all();
        return view('admin.user.list', compact('users'));
    }

    public function add()
    {
        // TODO: Implement add() method.
        return view('admin.user.add');
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