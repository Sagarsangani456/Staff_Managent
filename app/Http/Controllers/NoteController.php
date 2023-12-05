<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->can('note-manage'))
        {
            if(Auth::user()->type == 'super admin')
            {
                $note = Note::all();
            }
            else
            {
                $note = Note::where('created_by', Auth::user()->id)->get();
            }

            return view('admin.note.index', compact('note'));
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
        if(auth()->user()->can('note-create'))
        {
            return view('admin.note.create');
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
        if(auth()->user()->can('note-create'))
        {
            if(Auth::user()->type == 'super admin')
            {
                $valisator = Validator::make($request->all(), [
                    'title' => 'required',
                    'description' => 'required',
                ]);

                if($valisator->fails())
                {
                    $errors = $valisator->getMessageBag();

                    return redirect()->back()->with('error', $errors->first());
                }

                $attchment = '';

                $note        = new Note();
                $note->title = $request->title;
                if(!empty($request->attchment))
                {
                    $attchment      = $request->attchment;
                    $attchment_file = time() . $attchment->getClientOriginalName();
                    $attchment->move(public_path('attchment'), $attchment_file);

                    $note->attchment = $attchment_file;
                }
                $note->description = $request->description;
                $note->created_by  = Auth::user()->id;
                $note->save();

                return redirect()->back()->with('success', __('Data To Submited Successfully'));
            }
            else
            {
                $note = Note::where('created_by', Auth::user()->id)->get()->count();

                $maximum_notes = DB::table('plans')->where('id', Auth::user()->plan_id)->first();

                if($note < $maximum_notes->maximum_note)
                {
                    $valisator = Validator::make($request->all(), [
                        'title' => 'required',
                        'description' => 'required',
                    ]);

                    if($valisator->fails())
                    {
                        $errors = $valisator->getMessageBag();

                        return redirect()->back()->with('error', $errors->first());
                    }

                    $attchment = '';

                    $note        = new Note();
                    $note->title = $request->title;
                    if(!empty($request->attchment))
                    {
                        $attchment      = $request->attchment;
                        $attchment_file = time() . $attchment->getClientOriginalName();
                        $attchment->move(public_path('attchment'), $attchment_file);

                        $note->attchment = $attchment_file;
                    }
                    $note->description = $request->description;
                    $note->created_by  = Auth::user()->id;
                    $note->save();

                    return redirect()->back()->with('success', __('Data To Submited Successfully'));
                }
                else
                {
                    return redirect()->back()->with('error', __('Your Note Create Limit Is Over !!'));
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
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        //
    }
}
