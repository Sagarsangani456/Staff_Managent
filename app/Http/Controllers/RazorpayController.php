<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Plan;
use App\Models\Razorpay;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Razorpay\Api\Api;
use Session;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;


class RazorpayController extends Controller
{
    public function index(Request $request,$id)
    {
        $plan = Plan::find($id);

        if($request->totalamount)
        {
            $amount = round($request->totalamount);
        }
        else
        {
            $amount = round($plan->plan_price);
        }

        return view('admin.razorpay.index', compact('plan','amount'));

    }

    public function store(Request $request, $id)
    {

        $input = $request->all();

        $api = new Api('rzp_test_l7UTKT47t0bC3J', 'qfninkDRH5bfniMkTlHCtVnk');

        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        $transationid = '';

        if($payment->method == 'card')
        {
            $transationid = $payment->acquirer_data['auth_code'];
        }
        else if($payment->method == 'netbanking')
        {
            $transationid = $payment->acquirer_data['bank_transaction_id'];
        }
        else if($payment->method == 'upi')
        {
            $transationid = $payment->acquirer_data['upi_transaction_id'];
        }

        $data = [
            'name' => Auth::user()->name,
            'price' => $payment->amount / 100,
            'payment_type' => $payment->method,
            'payment_id' => $payment->id,
            'order_id' => rand(000000000,999999999),
            'created_by' => Auth::user()->creatorId(),
            'user_id' => Auth::user()->id,
            'transation_id' => $transationid,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $getId = Razorpay::insert($data);

        $user          = User::find(Auth::user()->id);
        $user->plan_id = $id;
        $user->plan_purchase_date = date('d-m-Y');
        $newmonth =  Carbon::now()->addMonth()->format('d-m-Y');
        $newyears =  Carbon::now()->addYears()->format('d-m-Y');

        $plan = Plan::find($id);

        if($plan->duration == 'Per Month')
        {
            $user->plan_expiry_date =  $newmonth;
        }
       if($plan->duration == 'Per Year')
        {
            $user->plan_expiry_date =  $newyears;
        }

        $user->update();


        if(count($input) && !empty($input['razorpay_payment_id']))
        {
            try
            {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));
            }
            catch(Exception $e)
            {
                return $e->getMessage();
                Session::put('error', $e->getMessage());

                return redirect()->back();
            }
        }
        return redirect()->route('plan.index')->with('success',__('Payment successful'));
    }
}
