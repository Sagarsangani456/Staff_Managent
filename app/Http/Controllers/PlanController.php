<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Plan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\SendRequest;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->can('plan-manage'))
        {
            $plan = Plan::all();
            $user = User::where('id', Auth::user()->id)->first();

            $plan_expiry    = User::where('plan_expiry_date', Auth::user()->plan_expiry_date)->first();
            $planexpiryDate = Carbon::parse($plan_expiry->plan_expiry_date)->format('d-m-Y');

            $planId = Plan::first();
            if($planexpiryDate == date('d-m-Y'))
            {
                $user                     = User::find(Auth::user()->id);
                $user->plan_id            = $planId->id;
                $user->plan_purchase_date = null;
                $user->plan_expiry_date   = null;
                $user->update();
            }

            return view('admin.plan.index', compact('plan', 'user', 'planexpiryDate'));
        }
        else
        {
            return redirect()->back()->with('error', __('Sorry ! You can Not be Permission'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(auth()->user()->can('plan-create'))
        {
            return view('admin.plan.create');
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
        if(auth()->user()->can('plan-create'))
        {
            $validator = Validator::make($request->all(), [
                'plan_name' => 'required',
                'plan_price' => 'required',
                'duration' => 'required',
                'maximum_user' => 'required',
                'maximum_contact' => 'required',
                'maximum_note' => 'required',
            ]);
            if($validator->fails())
            {
                $errors = $validator->getMessageBag();

                return redirect()->back()->with('error', $errors->first());
            }
            $plan                  = new Plan();
            $plan->plan_name       = $request->plan_name;
            $plan->plan_price      = $request->plan_price;
            $plan->duration        = $request->duration;
            $plan->maximum_user    = $request->maximum_user;
            $plan->maximum_contact = $request->maximum_contact;
            $plan->maximum_note    = $request->maximum_note;
            $plan->created_by      = Auth::user()->creatorId();
            $plan->save();

            return redirect()->back()->with('success', __('Data To Submited Successfully'));
        }
        else
        {
            return redirect()->back()->with('error', __('Sorry ! You can Not be Permission'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan $plan)
    {
        if(auth()->user()->can('plan-edit'))
        {
            return view('admin.plan.edit', compact('plan'));
        }
        else
        {
            return redirect()->back()->with('error', __('Sorry ! You can Not be Permission'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan $plan)
    {
        if(auth()->user()->can('plan-edit'))
        {
            $validator = Validator::make($request->all(), [
                'plan_name' => 'required',
                'plan_price' => 'required',
                'maximum_user' => 'required',
                'maximum_contact' => 'required',
                'maximum_note' => 'required',
            ]);
            if($validator->fails())
            {
                $errors = $validator->getMessageBag();

                return redirect()->back()->with('error', $errors->first());
            }
            $plan                  = $plan;
            $plan->plan_name       = $request->plan_name;
            $plan->plan_price      = $request->plan_price;
            $plan->duration        = $request->duration;
            $plan->maximum_user    = $request->maximum_user;
            $plan->maximum_contact = $request->maximum_contact;
            $plan->maximum_note    = $request->maximum_note;
            $plan->created_by      = Auth::user()->creatorId();
            $plan->update();

            return redirect()->back()->with('update', __('Data  Updated To Successfully'));
        }
        else
        {
            return redirect()->back()->with('error', __('Sorry ! You can Not be Permission'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        if(auth()->user()->can('plan-delete'))
        {
            $plan->delete();

            return redirect()->back()->with('success', __('Data Deleted To Successfully'));
        }
        else
        {
            return redirect()->back()->with('error', __('Sorry ! You can Not be Permission'));
        }
    }


}
