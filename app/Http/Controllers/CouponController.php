<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->can('coupon-manage'))
        {
            $coupons = Coupon::all();

            return view('admin.coupons.index', compact('coupons'));
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
        if(auth()->user()->can('coupon-create'))
        {
            return view('admin.coupons.create');
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
        if(auth()->user()->can('coupon-create'))
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'limit' => 'required',
                'code' => 'required',
            ]);

            if($validator->fails())
            {
                $errors = $validator->getMessageBag();

                return redirect()->back()->with('error', $errors->first());
            }

            $coupons               = new Coupon();
            $coupons->name         = $request->name;
            $coupons->discount     = $request->discount;
            $coupons->flatdiscount = $request->flatdiscount;
            $coupons->limit        = $request->limit;
            $coupons->code         = $request->code;
            $coupons->save();

            return redirect()->back()->with('success', __('Data Submited Successfully'));
        }
        else
        {
            return redirect()->back()->with('error', __('Sorry ! You can Not be Permission'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon)
    {
        if(auth()->user()->can('coupon-edit'))
        {
            return view('admin.coupons.edit', compact('coupon'));
        }
        else
        {
            return redirect()->back()->with('error', __('Sorry ! You can Not be Permission'));
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coupon $coupon)
    {
        if(auth()->user()->can('coupon-edit'))
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'limit' => 'required',
                'code' => 'required',
            ]);

            if($validator->fails())
            {
                $errors = $validator->getMessageBag();

                return redirect()->back()->with('error', $errors->first());
            }

            $coupons               = $coupon;
            $coupons->name         = $request->name;
            $coupons->discount     = $request->discount;
            $coupons->flatdiscount = $request->flatdiscount;
            $coupons->limit        = $request->limit;
            $coupons->code         = $request->code;
            $coupons->update();

            return redirect()->back()->with('success', __('Data Updated To Successfully'));
        }
        else
        {
            return redirect()->back()->with('error', __('Sorry ! You can Not be Permission'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        if(auth()->user()->can('coupon-delete'))
        {
            $coupon->delete();

            return redirect()->back()->with('success', __('Coupon Data Deleted Successfully'));
        }
        else
        {
            return redirect()->back()->with('error', __('Sorry ! You can Not be Permission'));
        }
    }

    public function coupon_apply(Request $request)
    {
        $planId = Plan::find($request->id);

        $couponData = Coupon::where('code', $request->code)->first();

        if($couponData->discount != null)
        {

            $coupondiscount = $couponData->discount / 100 * $planId->plan_price;

            $totalAmount = $planId->plan_price - $coupondiscount;
        }
        else
        {
            $coupondiscount = $planId->plan_price - $couponData->flatdiscount;
            $totalAmount    = $coupondiscount;

        }

        if($couponData->limit != 0)
        {
            $couponlimit        = Coupon::find($couponData->id);
            $couponlimit->limit = $couponData->limit - 1;
            $couponlimit->update();
        }
        else
        {
            return redirect()->back()->with('error', __('Your Coupon Is Expired'));
        }

        return $totalAmount;
    }
}
