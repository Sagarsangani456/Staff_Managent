<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->can('role-manage'))
        {

            $role = Role::where('name', '!=', 'Superadmin')->with([
                                                                      'permissions',
                                                                      'users',
                                                                  ])->get();

            return view('admin.role.index', compact('role'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(auth()->user()->can('role-create'))
        {

            $permissions = Permission::orderBy('group')->get()->groupBy(function ($data){
                return $data->group;
            });

            return view('admin.role.create', compact('permissions'));
        }
        else
        {
            return redirect()->back()->with('error', __('Sorry ! You can Not be Permission'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(auth()->user()->can('role-create'))
        {


            $validator = Validator::make(
                $request->all(), [
                                   'name' => 'required|unique:roles',
                                   'permissions' => 'required',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->withInput()->with('error', $messages->first());
            }
            $role = Role::create(['name' => $request->name]);
            foreach($request->permissions as $permission_id)
            {
                $permission = Permission::find($permission_id);
                $role->givePermissionTo($permission);
            }

            return redirect()->back()->with('success', __('Role created'));
        }
        else
        {
            return redirect()->back()->with('error',__( 'Sorry ! You can Not be Permission'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if(auth()->user()->can('role-edit'))
        {
            $role                 = Role::where('id', $id)->with(['permissions'])->first();
            $permissions          = Permission::orderBy('group')->get()->groupBy(function ($data){
                return $data->group;
            });
            $selected_permissions = $role->permissions->pluck('id')->toArray();

            return view('admin.role.edit', compact('permissions', 'selected_permissions', 'role'));
        }
        else
        {
            return redirect()->back()->with('error', __('Sorry ! You can Not be Permission'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        if(auth()->user()->can('role-edit'))
        {


            $role      = $role;
            $validator = Validator::make(
                $request->all(), [
                                   'name' => 'required|unique:roles,name,' . $role->id . ',id',
                                   'permissions' => 'required',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
            $permissions = Permission::all();
            foreach($permissions as $permission)
            {
                $role->revokePermissionTo($permission);
            }
            foreach($request->permissions as $permission_id)
            {
                $permission = Permission::find($permission_id);
                $role->givePermissionTo($permission);
            }
            $role->name = $request->name;
            $role->update();

            return redirect()->back()->with('success', __('Role updated'));
        }
        else
        {
            return redirect()->back()->with('error', __('Sorry ! You can Not be Permission'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if(auth()->user()->can('role-delete'))
        {

            $role = Role::where('id', $id)->with([
                                                     'users',
                                                     'permissions',
                                                 ])->first();

            foreach($role->permissions as $permission)
            {
                $role->revokePermissionTo($permission);
            }
            $role->delete();

            return redirect()->back()->with('delete', __('Role deleted'));
        }
        else
        {
            return redirect()->back()->with('error', __('Sorry ! You can Not be Permission'));
        }
    }
}
