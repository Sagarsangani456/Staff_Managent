<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DateTime;
use carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->can('contact-manage'))
        {
            if(Auth::user()->type == 'super admin')
            {
                $contact = Contact::all();
            }
            else
            {
                $contact = Contact::where('created_by', Auth::user()->id)->get();
            }

            return view('admin.contact.index', compact('contact'));
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
        if(auth()->user()->can('contact-create'))
        {
            return view('admin.contact.create');
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
        if(auth()->user()->can('contact-create'))
        {
            if(Auth::user()->type == 'super admin')
            {
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'email' => 'required',
                    'contact_number' => 'required',
                    'subject' => 'required',
                    'message' => 'required',
                ]);
                if($validator->fails())
                {
                    $errors = $validator->getMessageBag();

                    return redirect()->back()->with('error', $errors->first());
                }

                $contact                 = new Contact();
                $contact->name           = $request->name;
                $contact->email          = $request->email;
                $contact->contact_number = $request->contact_number;
                $contact->subject        = $request->subject;
                $contact->message        = $request->message;
                $contact->created_by     = Auth::user()->id;
                $contact->save();

                return redirect()->back()->with('success', __('Data To Submited Successfully'));
            }
            else
            {
                $contact = Contact::where('created_by', Auth::user()->id)->get()->count();

                $maximum_contacts = DB::table('plans')->where('id', Auth::user()->plan_id)->first();


                if($contact < $maximum_contacts->maximum_contact)
                {
                    $validator = Validator::make($request->all(), [
                        'name' => 'required',
                        'email' => 'required',
                        'contact_number' => 'required',
                        'subject' => 'required',
                        'message' => 'required',
                    ]);
                    if($validator->fails())
                    {
                        $errors = $validator->getMessageBag();

                        return redirect()->back()->with('error', $errors->first());
                    }

                    $contact                 = new Contact();
                    $contact->name           = $request->name;
                    $contact->email          = $request->email;
                    $contact->contact_number = $request->contact_number;
                    $contact->subject        = $request->subject;
                    $contact->message        = $request->message;
                    $contact->created_by     = Auth::user()->id;
                    $contact->save();

                    return redirect()->back()->with('success', __('Data To Submited Successfully'));
                }
                else
                {
                    return redirect()->back()->with('error', __('Your Contact Create Limit Is Over'));
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
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {

        if(auth()->user()->can('contact-edit'))
        {
            return view('admin.contact.edit', compact('contact'));
        }
        else
        {
            return redirect()->back()->with('error', __('Sorry ! You can Not be Permission'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        if(auth()->user()->can('contact-edit'))
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required',
                'contact_number' => 'required',
                'subject' => 'required',
                'message' => 'required',
            ]);
            if($validator->fails())
            {
                $errors = $validator->getMessageBag();

                return redirect()->back()->with('error', $errors->first());
            }

            $contact                 = $contact;
            $contact->name           = $request->name;
            $contact->email          = $request->email;
            $contact->contact_number = $request->contact_number;
            $contact->subject        = $request->subject;
            $contact->message        = $request->message;
            $contact->update();

            return redirect()->back()->with('success', __('Data  Updated To Successfully'));
        }
        else
        {
            return redirect()->back()->with('error', __('Sorry ! You can Not be Permission'));
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        if(auth()->user()->can('contact-delete'))
        {

            $contact->delete();

            return redirect()->back()->with([
                                                "status" => 0,
                                                'success' => 'Data Deleted To Successfully',
                                            ]);
        }
        else
        {
            return redirect()->back()->with('error', __('Sorry ! You can Not be Permission'));
        }
    }
}
