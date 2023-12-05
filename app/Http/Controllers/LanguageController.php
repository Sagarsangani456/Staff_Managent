<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Util\Filesystem;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting     = Utility::setting();
        $currantLang = App::currentLocale();

        //        $language = Language::all();
        $languages = Language::pluck('language_name', 'language_code');


        if(!empty($setting['language']))
        {
            $disabledLang = explode(',', $setting['language']);
        }
        else
        {
            $disabledLang = [];
        }

        $dir = base_path() . '/resources/lang/' . $currantLang;

        if(!is_dir($dir))
        {
            $dir = base_path() . '/resources/lang/en';
        }

        $arrylabel = json_decode(file_get_contents($dir . '.json'));

        $arryfile    = array_diff(
            scandir($dir), array(
                             '..',
                             '.',
                         )
        );
        $arrymessage = [];

        foreach($arryfile as $file)
        {
            $filename = basename($file, ".php");
            $filedata = $myarray = include $dir . "/" . $file;
            if(is_array($filedata))
            {
                $arrMessage[$filename] = $filedata;
            }
        }

        return view('admin.language.index', compact('languages', 'arrylabel', 'currantLang', 'setting', 'disabledLang', 'arrMessage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.language.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'language_code' => 'required',
            'language_name' => 'required',
        ]);

        if($validator->fails())
        {
            $errors = $validator->getMessageBag();

            return redirect()->back()->with('error', $errors->first());
        }

        $language                = new Language();
        $language->language_code = $request->language_code;
        $language->language_name = $request->language_name;
        $language->created_by    = Auth::user()->id;
        $language->save();

        return redirect()->back()->with('success', __('Data  Submited To Successfully'));

    }

    /**
     * Display the specified resource.
     */
    public function show(Language $language)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Language $language)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Language $language)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Language $language)
    {
        //
    }

    public function storeLanguageData(Request $request, $currantLang)
    {
        $filesystem = new Filesystem();
        $dir        = base_path() . '/resources/lang';

        if(!is_dir($dir))
        {
            mkdir($dir);
            @chmod($dir, 0777);
        }

        $jsonfile = $dir . "/" . $currantLang . ".json";

        if(isset($request->label) && !empty($request->label))
        {
            file_put_contents($jsonfile, json_encode($request->label));
        }
        $langfolder = $dir . "/" . $currantLang;

        if(!is_dir($langfolder))
        {
            mkdir($langfolder);
            @chmod($langfolder, 0777);
        }

        return redirect()->route('language.index', [$currantLang])->with('success', 'Language Saved Successfully');
    }

    public function LanguageData($code)
    {

        $setting     = Utility::setting();
        $currantLang = $code;
        //        $language = Language::all();
        $languages = Language::pluck('language_name', 'language_code');

        if(!empty($setting['language']))
        {
            $disabledLang = explode(',', $setting['language']);
        }
        else
        {
            $disabledLang = [];
        }

        $dir = base_path() . '/resources/lang/' . $currantLang;

        if(!is_dir($dir))
        {
            $dir = base_path() . '/resources/lang/en';
        }

        $arrylabel = json_decode(file_get_contents($dir . '.json'));

        $arryfile    = array_diff(
            scandir($dir), array(
                             '..',
                             '.',
                         )
        );
        $arrymessage = [];

        foreach($arryfile as $file)
        {
            $filename = basename($file, ".php");
            $filedata = $myarray = include $dir . "/" . $file;
            if(is_array($filedata))
            {
                $arrMessage[$filename] = $filedata;
            }
        }

        return view('admin.language.index', compact('languages', 'arrylabel', 'currantLang', 'setting', 'disabledLang', 'arrMessage'));


        //        $dir = base_path().'/resources/lang/';
        //        $jsonfile = $dir."/".$code.".json";
        //        $changelanguage = json_decode(file_get_contents($jsonfile));
        //        dd($changelanguage);
        //        return redirect()->route('language.index',compact('changelanguage'));
    }

    public function changeLanguage($language)
    {

        App::setLocale($language);
        Session::put("locale", $language);

        return redirect()->back()->with('success', __('Language change successfully.'));
    }

}
