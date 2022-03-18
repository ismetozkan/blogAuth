<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Str;

class SettingsController extends Controller
{
    public function index()
    {
        $settings= Setting::find(1);
        return view('back.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings=Setting::find(1);
        $settings->title= $request->title;
        $settings->status= $request->status;
        $settings->facebook= $request->facebook;
        $settings->twitter= $request->twitter;
        $settings->github= $request->github;
        $settings->linkedin= $request->linkedin;
        $settings->instagram= $request->instagram;
        if($request->hasFile('logo')){
            $logo=Str::slug($request->title).'-logo.'.$request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('uploads/'),$logo);
            $settings->logo='uploads/'.$logo;

        }if($request->hasFile('favicon')){
            $favicon=Str::slug($request->title).'-favicon.'.$request->favicon->getClientOriginalExtension();
            $request->favicon->move(public_path('uploads/'),$favicon);
            $settings->favicon='uploads/'.$favicon;
        }
        $settings->save();
        return redirect()->route('admin.settings');

    }
}
