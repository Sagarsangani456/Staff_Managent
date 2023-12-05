<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Testing\Fluent\Concerns\Has;
use App\Models\Utility;


class SettingController extends Controller
{

    // Start Account Setting
    public function index()
    {
        if(Auth::user()->type == 'super admin')
        {
            $account_user = User::where('id', auth()->user()->id)->first();
        }
        else
        {
            $account_user = User::where('craeted_by',Auth::user()->creatorId());
        }

        return view('admin.account.index', compact('account_user'));
    }

    public function account_update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',

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

        $user->save();

        return redirect()->back()->with('update', __('Data Updated To Successfully'));
    }

    //  End Account

    //  Start Password Setting

    public function password_setting()
    {
        if(Auth::user()->type == 'super admin')
        {
            $user = User::where('id', auth()->user()->id)->first();
        }
        else
        {
            $user = User::where('craeted_by',Auth::user()->creatorId());
        }

        return view('admin.password.index', compact('user'));
    }

    public function change_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);
        if($validator->fails())
        {
            $errors = $validator->getMessageBag();

            return redirect()->back()->with('error', $errors->first());
        }

        if(!Hash::check($request->current_password, auth()->user()->password))
        {
            return redirect()->back()->with('error', __('Old Password Does Not match'));
        }

        User::whereId(auth()->user()->id)->update([
                                                      'password' => Hash::make($request->new_password),
                                                  ]);

        return redirect()->back()->with('success', __('Password has been Updated!'));
    }

    // End Password Setting

    // Start General Setting

    public function general_setting()
    {
            return view('admin.general.index');
    }

    public function general_store(Request $request)
    {
        if(!empty(Auth::user()))
        {
            if($request->name)
            {
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                ]);
                if($validator->fails())
                {
                    $errors = $validator->getMessageBag();

                    return redirect()->back()->with('error', $errors->first());
                }

                $general = $request->name;
                $user_id = Auth::user()->id;


                DB::insert('insert into settings (`value`,`name`,`created_by`,`created_at`,`updated_at`) values(?,?,?,?,?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`)', [
                    $general,
                    'name',
                    Auth::user()->creatorId(),
                    date('Y-m-d H:i:s'),
                    date('Y-m-d H:i:s'),
                ]);

            }
            if($request->website_logo)
            {
                $website_logo = '';

                $image        = $request->website_logo;
                $website_logo = time() . $image->getClientOriginalName();
                $image->move(public_path('image'), $website_logo);

                DB::insert('insert into settings(`name`,`value`,`created_by`,`created_at`,`updated_at`) values (?,?,?,?,?) ON DUPLICATE KEY UPDATE `value` = VALUES (`value`)', [
                    'website_logo',
                    $website_logo,
                    Auth::user()->creatorId(),
                    date('Y-m-d H:i:s'),
                    date('Y-m-d H:i:s'),
                ]);
            }

            if($request->website_favicon)
            {
                $favicon_logo = '';

                $image           = $request->website_favicon;
                $website_favicon = time() . $image->getClientOriginalName();
                $image->move(public_path('image'), $website_favicon);

                DB::insert('insert into settings(`name`,`value`,`created_by`,`created_at`,`updated_at`) values (?,?,?,?,?) ON DUPLICATE KEY UPDATE `value` = VALUES (`value`)', [
                    'website_favicon',
                    $website_favicon,
                    Auth::user()->creatorId(),
                    date('Y-m-d H:i:s'),
                    date('Y-m-d H:i:s'),
                ]);
            }

            return redirect()->back()->with('success', __('Setting Data Submited successfully .'));
        }
        else
        {
            return redirect()->back()->with('error', __('Data Not Created.'));
        }
    }


    // End General Setting


    // Start Company Setting

    public function company_setting()
    {
            $language = Language::all();
            return view('admin.company.index',compact('language'));
    }

    public function company_store(Request $request)
    {

        if(!empty(Auth::user()))
        {
            $validator = Validator::make($request->all(), [
                'company_name' => 'required',
                'company_email' => 'required',
                'company_phone' => 'required',
                'company_address' => 'required',
                'city' => 'required',
                'state' => 'required',
                'country' => 'required',
                'zip_code' => 'required',
                'company_symbol' => 'required',
                'timezone' => 'required',
                'date' => 'required',
                'time' => 'required',
                'language'=>'required',
            ]);

            if($validator->fails())
            {
                $errors = $validator->getMessageBag();

                return redirect()->back()->with('error', $errors->first());
            }
            $company_setting = $request->all();

            unset($company_setting['_token']);

            foreach($company_setting as $key => $data)
            {
                DB::insert('insert into settings (`name`,`value`,`created_by`,`created_at`,`updated_at`) values (?,?,?,?,?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`)', [
                    $key,
                    $data,
                    Auth::user()->creatorId(),
                    date('Y-m-d H:i:s'),
                    date('Y-m-d H:i:s'),
                ]);
            }

            return redirect()->back()->with('success', __(' Company Settings Data Submited To successfully .'));
        }
        else
        {
            return redirect()->back()->with('error', __('Company Settings Not Submited.'));
        }
    }

    // End Company Setting

    //Start Email setting
    public function email_setting(Utility $utility)
    {
        return view('admin.email.index');
    }

    public function email_store(Request $request)
    {
        if(!empty(Auth::user()))
        {
            $validator = Validator::make($request->all(), [
                'email_server_driver' => 'required',
                'email_server_host' => 'required',
                'email_server_port' => 'required',
                'email_serveru_sername' => 'required',
                'email_server_password' => 'required',
                'email_server_encryption' => 'required',
                'from_email' => 'required',
                'from_name' => 'required',
            ]);

            if($validator->fails())
            {
                $errors = $validator->getMessageBag();

                return redirect()->back()->with('error', $errors->first());
            }

            $email = $request->all();
            unset($email['_token']);

            foreach($email as $key => $data)
            {
                DB::insert('insert into settings (`name`,`value`,`created_by`,`created_at`,`updated_at`) values (?,?,?,?,?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`)', [
                    $key,
                    $data,
                    Auth::user()->creatorId(),
                    date('Y-m-d H:i:s'),
                    date('Y-m-d H:i:s'),
                ]);
            }

            return redirect()->back()->with('success', __(' Email Settings Data Submited To successfully .'));
        }
        else
        {
            return redirect()->back()->with('error', __('Email Settings Not Submited.'));
        }
    }

    // End Email Setting

    // Payment Setting Start

    public function payment_setting()
    {
        return view('admin.payment_setting.index');
    }

    public function payment_store(Request $request)
    {
        if(!empty(Auth::user()))
        {
            $validator = Validator::make($request->all(), [
                'razorpay_key' => 'required',
                'razorpay_secret' => 'required',

            ]);

            if($validator->fails())
            {
                $errors = $validator->getMessageBag();

                return redirect()->back()->with('error', $errors->first());
            }

            $payment_setting = $request->all();
            unset($payment_setting['_token']);

            foreach($payment_setting as $key => $data)
            {
                DB::insert('insert into settings (`name`,`value`,`created_by`,`created_at`,`updated_at`) values (?,?,?,?,?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`)', [
                    $key,
                    $data,
                    Auth::user()->creatorId(),
                    date('Y-m-d H:i:s'),
                    date('Y-m-d H:i:s'),
                ]);
            }

            return redirect()->back()->with('success', __(' Payment Settings Data Submited To successfully .'));
        }
        else
        {
            return redirect()->back()->with('error', __('Payment Settings Not Submited.'));
        }
    }

}
