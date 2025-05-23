<?php

namespace App\Http\Controllers\Admin;


use Carbon\Carbon;
use App\Models\Language;

use Dotenv\Exception\ValidationException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Notifications\NewPostNotification;
use Illuminate\Validation\Rule;
use Mockery\Exception;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


class LanguageController extends Controller
{




    public function index(Request $request)
    {

        $languages = Language::latest('id')->get();

        return view('admins.languages.index', compact('languages'));
    }



    public function create()
    {
        return view('admins.languages.create');
    }




    public function store(Request $request)
    {

        $roles = [
            'code' => 'required',
        ];

        $locales = Language::active()->get()->pluck('code');

        foreach ($locales as $locale) {
            $roles['name_' . $locale] = 'required';
        }

        $item = new Language();
        $item->code = $request->code;

        foreach ($locales as $locale) {
            $item->translateOrNew($locale)->name = $request->get('name_' . $locale);
        }

        $item->save();

        flash()->success('Language Created Successfully');
        return redirect()->route('admin.language.index');
    }




    public function edit(Language $language)
    {

        // $language = Language::findOrFail($id);

        return view('admins.languages.edit', compact('language'));
    }


    public function show($id)
    {
        //
    }


    public function update(Request $request, Language $language)
    {

        $roles = [
            'code' => 'required',
        ];

        $locales = Language::all()->pluck('code');

        foreach ($locales as $locale) {
            $roles['name_' . $locale] = 'required';
        }


        $language->code = $request->code;

        foreach ($locales as $locale) {
            $language->translateOrNew($locale)->name = $request->get('name_' . $locale);
        }

        $language->save();

        flash()->success('Language Updated Successfully');
        return redirect()->route('admin.language.index')->with('status', __('translate.updatedSucc'));
    }


    public function destroy(Language $language)
    {
        $language->delete();
        flash()->success('Language Deleted Successfully');
        return redirect()->route('admin.language.index')->with('status', __('translate.updatedSucc'));
    }
}
