<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->can('user-manage'))
        {
            $user = User::where('created_by', Auth::user()->id)->get();


            return view('admin.user.index', compact('user'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(auth()->user()->can('user-create'))
        {
            $roles = Role::all();

            return view('admin.user.create', compact('roles'));
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
        if(auth()->user()->can('user-create'))
        {
            if(Auth::user()->type == 'super admin')
            {
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'email' => 'required',
                    'password' => 'required|same:confirm-password',
                    'role' => 'required',
                ]);

                if($validator->fails())
                {
                    $errors = $validator->getMessageBag();

                    return redirect()->back()->with('error', $errors->first());
                }

                $filename = '';

                $image    = $request->image;
                $filename = time() . $image->getClientOriginalName();
                $image->move(public_path('image'), $filename);

                $user             = new User();
                $user->name       = $request->name;
                $user->email      = $request->email;
                $user->password   = Hash::make($request->password);
                $user->image      = $filename;
                $user->created_by = Auth::user()->id;
                $user->type       = $request->role;

                $user->save();

                $user->assignRole($request->input('role'));


                return redirect()->back()->with('success', __('Data Submited Successfully'));
            }
            else
            {
                $user = User::where('created_by', Auth::user()->id)->get()->count();

                $maximum_users = DB::table('plans')->where('id', Auth::user()->plan_id)->first();


                if($user < $maximum_users->maximum_user)
                {

                    $validator = Validator::make($request->all(), [
                        'name' => 'required',
                        'email' => 'required',
                        'password' => 'required|same:confirm-password',
                        'role' => 'required',
                    ]);

                    if($validator->fails())
                    {
                        $errors = $validator->getMessageBag();

                        return redirect()->back()->with('error', $errors->first());
                    }

                    $filename = '';

                    $image    = $request->image;
                    $filename = time() . $image->getClientOriginalName();
                    $image->move(public_path('image'), $filename);

                    $user             = new User();
                    $user->name       = $request->name;
                    $user->email      = $request->email;
                    $user->password   = Hash::make($request->password);
                    $user->image      = $filename;
                    $user->created_by = Auth::user()->id;
                    $user->type       = $request->role;

                    $user->save();

                    $user->assignRole($request->input('role'));


                    return redirect()->back()->with('success', __('Data Submited Successfully'));
                }
                else
                {
                    return redirect()->back()->with('error', __('Your User Create Limit Is Over'));
                }
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Sorry ! You can Not be Permission'));
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        //        $user = User::find($id);
        //
        //        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(auth()->user()->can('user-edit'))
        {
            $edit  = User::find($id);
            $roles = Role::all();

            return view('admin.user.edit', compact('edit', 'roles'));
        }
        else
        {
            return redirect()->back()->with('error', __('Sorry ! You can Not be Permission'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(auth()->user()->can('user-edit'))
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required',
                'role' => 'required',

            ]);
            if($validator->fails())
            {
                $errors = $validator->getMessageBag();

                return redirect()->back()->with('error', $errors->first());
            }

            $user        = User::find($id);
            $user->name  = $request->name;
            $user->email = $request->email;

            if(!empty($request->image))
            {
                $image    = $request->image;
                $filename = time() . $image->getClientOriginalName();
                $image->move(public_path('image'), $filename);

                $user->image = $filename;
            }
            $user->type = $request->role;
            DB::table('model_has_roles')->where('model_id', $id)->delete();
            $user->update();

            $user->assignRole($request->input('role'));


            return redirect()->back()->with('update', __('Data Updated To Successfully'));
        }
        else
        {
            return redirect()->back()->with('error',  __('Sorry ! You can Not be Permission'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(auth()->user()->can('user-delete'))
        {
            $delete = User::find($id);
            $delete->delete();

            return redirect()->back()->with('delete', __('User Deleted To Successfully'));
        }
        else
        {
            return redirect()->back()->with('error',  __('Sorry ! You can Not be Permission'));
        }
    }
}
