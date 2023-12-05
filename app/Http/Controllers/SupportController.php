<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Support;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SupportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->can('support-manage'))
        {
            if(Auth::user()->type == 'super admin')
            {
                $support = Support::all();
            }
            else
            {
                $support = Support::where('created_by',Auth::user()->id)->get();
            }

            return view('admin.supports.index', compact('support'));
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
        if(auth()->user()->can('support-create'))
        {
            $user = User::all();

            return view('admin.supports.create', compact('user'));
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
        if(auth()->user()->can('support-create'))
        {

            $validator = Validator::make($request->all(), [
                'subject' => 'required',
                'user_assign' => 'required',
                'priority' => 'required',
                'status' => 'required',
                'description' => 'required',
            ]);

            if($validator->fails())
            {
                $errors = $validator->getMessageBag();

                return redirect()->back()->with('error', $errors->first());
            }


            $attchment = '';


            $support              = new Support();
            $support->created_by  = Auth::user()->id;
            $support->subject     = $request->subject;
            $support->user_assign = $request->user_assign;
            if(!empty($request->attchment))
            {
                $attchment      = $request->attchment;
                $attchment_file = time() . $attchment->getClientOriginalName();
                $attchment->move(public_path('attchment'), $attchment_file);

                $support->attchment = $attchment_file;
            }
            $support->priority    = $request->priority;
            $support->status      = $request->status;
            $support->description = $request->description;
            $support->save();

            return redirect()->back()->with('success', __('Data Submited To Successfully'));
        }
        else
        {
            return redirect()->back()->with('error', __('Sorry ! You can Not be Permission'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Support $support)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Support $support)
    {
        if(auth()->user()->can('support-edit'))
        {
            $user = User::all();

            return view('admin.supports.edit', compact('support', 'user'));
        }
        else
        {
            return redirect()->back()->with('error', __('Sorry ! You can Not be Permission'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Support $support)
    {
        if(auth()->user()->can('support-edit'))
        {
            $validator = Validator::make($request->all(), [
                'subject' => 'required',
                'user_assign' => 'required',
                'priority' => 'required',
                'status' => 'required',
                'description' => 'required',
            ]);
            if($validator->fails())
            {
                $errors = $validator->getMessageBag();

                return redirect()->back()->with('error', $errors->first());
            }


            $attchment = '';


            $support = $support;

            $support->subject     = $request->subject;
            $support->user_assign = $request->user_assign;
            if(!empty($request->attchment))
            {
                $attchment      = $request->attchment;
                $attchment_file = time() . $attchment->getClientOriginalName();
                $attchment->move(public_path('attchment'), $attchment_file);

                $support->attchment = $attchment_file;
            }
            $support->priority    = $request->priority;
            $support->status      = $request->status;
            $support->description = $request->description;
            $support->save();

            return redirect()->back()->with('success', __('Data Submited To Successfully'));
        }
        else
        {
            return redirect()->back()->with('error', __('Sorry ! You can Not be Permission'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Support $support)
    {
        if(auth()->user()->can('support-delete'))
        {
            $support->delete();

            return redirect()->back()->with('success', __('Data Deleted Successfully'));
        }
        else
        {
            return redirect()->back()->with('error', __('Sorry ! You can Not be Permission'));
        }
    }

    public function reply($id)
    {
        $reply   = Support::find($id);
        $comment = Comment::where('support_id', $id)->get();

        return view('admin.supports.reply', compact('reply', 'comment'));
    }

    public function reply_store(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'comment' => 'required',
        ]);
        if($validator->fails())
        {
            $errors = $validator->getMessageBag();

            return redirect()->back()->with('error', $errors->first());
        }


        $comment             = new Comment();
        $comment->created_by = Auth::user()->id;
        $comment->support_id = $id;
        $comment->comment    = $request->comment;
        $comment->save();

        return redirect()->back()->with('success', __('Comment To Submited Successfully'));
    }


}
