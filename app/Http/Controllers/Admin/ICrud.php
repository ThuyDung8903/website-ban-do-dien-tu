<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

interface ICrud
{
    public function list(Request $request);

    public function add();

    public function doAdd(Request $request);

    public function edit($id);

    public function doEdit($id, Request $request);

    public function delete($id);
}