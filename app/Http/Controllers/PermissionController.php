<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permission = Permission::all();

        return view('admin.permission.index', compact('permission'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(), [
                               'name' => 'required|unique:permissions',
                               'group' => 'required',
                           ]
        );
        if($validator->fails())
        {
            $errors = $validator->getMessageBag();

            return redirect()->back()->with('error', $errors->first());
        }
        $permission        = new Permission();
        $permission->name  = $request->name;
        $permission->group = $request->group;
        $permission->save();

        return redirect()->back()->with('success', __('Permission created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        return view('admin.permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $validator = Validator::make(
            $request->all(), [
                               'name' => 'required|unique:permissions,name,' . $permission->id,
                               'group' => 'required',
                           ]
        );
        if($validator->fails())
        {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }
        $permission        = $permission;
        $permission->name  = $request->name;
        $permission->group = $request->group;
        $permission->update();

        return redirect()->back()->with('success', __('Permission updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {

        $permission->delete();

        return redirect()->back()->with('error', __('Permission deleted'));
    }
}
