<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;

class RoleController extends Controller
{

    // index
    public function index()
    {
        $roles = \App\Models\Role::all();
        return view('roles.index', compact('roles'));
    }

    // create
    public function create()
    {
        return view('roles.create');
    }

    // store
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|unique:roles|max:255',
        ]);

        $role = new \App\Models\Role;
        $role->name = $request->name;
        $role->save();

        return redirect('roles');
    }

    // show
    public function show($id)
    {
        $role = \App\Models\Role::findOrFail($id);

        return view('roles.show', ['role' => $role]);
    }

    // edit
    public function edit($id)
    {
        $role = \App\Models\Role::findOrFail($id);

        return view('roles.edit', ['role' => $role]);
    }

    // update
    public function update(Request $request, $id)
    {
        // Validate the request...
        $request->validate([
            'name' => 'required|unique:roles|max:255',
        ]);

        $role = \App\Models\Role::findOrFail($id);

        $role->name = $request->name;

        $role->save();

        return redirect('roles');
    }
    // destroy
    public function destroy($id)
    {
        $role = \App\Models\Role::findOrFail($id);

        $role->delete();

        return redirect('roles');
    }
}
