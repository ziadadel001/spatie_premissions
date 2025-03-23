<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class permissionController extends Controller
{
    //* this method will show permissions page
    public function index()
    {
        return view('permissions.list');
    }

    //* this method will show create permission page
    public function create()
    {
        return view('permissions.create');
    }

    //* this method will insert permission in DB
    public function store(Request $request)
    {
        // validate the permission name 
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions|min:3'
        ]);

        if ($validator->passes()) {
            // store the permission in DB if vaild 
            Permission::create(['name' => $request->name]);
            return redirect()->route('permission.index')->with('success', 'Permission added successfully.');
        } else {
            return redirect()->route('permission.create')->withInput()->withErrors($validator);
        }
    }
    //* this method will show edit permission page
    public function edit() {}
    //* this method will update permission in DB
    public function update() {}

    //* this method will delete permission in DB
    public function destroy() {}
}
