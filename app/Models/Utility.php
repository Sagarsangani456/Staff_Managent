<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Setting;
Use Carbon\Carbon;

class Utility extends Model
{
    use HasFactory;

    public static function setting()
    {
        $setting_data = DB::table('settings')->get();

//        $userId = \Auth::user()->id;

//        $setting_data = $setting_data->where('created_by', '=', $userId);

        $settings = [
            "name" => "",
            "website_logo" => "",
            "website_favicon" => "",
            "company_name" => "",
            "company_email" => "",
            "company_phone" => "",
            "company_address" => "",
            "city" => "",
            "state" => "",
            "country" => "",
            "zip_code" => "",
            "company_symbol" => "",
            "timezone" => "",
            "date" => "",
            "time" => "",
            "email_server_driver" => "",
            "email_server_host" => "",
            "email_server_port" => "",
            "email_serveru_sername" => "",
            "email_server_password" => "",
            "email_server_encryption" => "",
            "from_email" => "",
            "from_name" => "",
            "razorpay_key"=>"",
            "razorpay_secret"=>"",

        ];

        foreach($setting_data as $data)
        {
            $settings[$data->name] = $data->value;
        }

        return $settings;
    }

    public static function settingdata($key)
    {
        $setting = Utility::setting();

        if(!isset($setting[$key]) || empty($setting[$key]))
        {
            $setting[$key] = '';
        }

        return $setting[$key];
    }

    public static function dateformat($date)
    {
        $setting = Setting::get();

//        $datetimeformat = date('y-m-d',$date);
        $datetimeformat = Carbon::parse($date)->format('M j,Y');

        return $datetimeformat;
    }

}
