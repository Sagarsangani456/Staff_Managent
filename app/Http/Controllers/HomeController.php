<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Plan;
use App\Models\Support;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->type == 'super admin')
        {

            $user    = User::count();
            $contact = Contact::count();
            $support = Support::count();

            $support_latest = Support::latest()->get();

            $expnse = Support::whereDate('created_at', Carbon::today())->count();

            if($expnse)
            {
                $expnse_count = $expnse + 1;
            }
            else
            {
                $expnse_count = 1;
            }
        }
        else
        {
            $user    = User::count();
            $contact = Contact::count();
            $support = Support::count();


            $support_latest = Support::latest()->get();

            $expnse = Support::whereDate('created_at', Carbon::today())->count();

            if($expnse)
            {
                $expnse_count = $expnse + 1;
            }
            else
            {
                $expnse_count = 1;
            }
        }

        $plan_expiry      = User::where('plan_expiry_date', Auth::user()->plan_expiry_date)->first();

        $expirydate      = Carbon::parse($plan_expiry->plan_expiry_date);
        $today           = Carbon::now();
        $daysUntilExpiry = $today->diffInDays($expirydate);

        $plan = Plan::count();

        return view('home', compact('user', 'contact', 'support', 'support_latest', 'expirydate','expnse_count','daysUntilExpiry','plan'));
    }
}
