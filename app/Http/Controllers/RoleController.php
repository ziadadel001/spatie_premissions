<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    //* this method will show roles page
    public function index()
    {
        return view('roles.list');
    }

    //* this method will show create role page
    public function create()
    {
        $permissions = Permission::orderBy('name', 'ASC')->get();
        return view('roles.create', compact('permissions'));
    }

    //* this method will insert role in DB
    public function store(Request $request)
    {
        // validate the Role name 
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles|min:3'
        ]);

        if ($validator->passes()) {
            // store the Role in DB if vaild 
            $role =  Role::create(['name' => $request->name]);
            if (!empty($request->permission)) {
                foreach ($request->permission as $name) {
                    $role->givePermissionTo($name);
                }
            }
            return redirect()->route('roles.index')->with('success', 'Role added successfully.');
        } else {
            return redirect()->route('roles.create')->withInput()->withErrors($validator);
        }
    }




    //* this method will show edit role page
    public function edit() {}



    //* this method will update role in DB
    public function update() {}

    //* this method will delete role in DB
    public function destroy() {}
}
