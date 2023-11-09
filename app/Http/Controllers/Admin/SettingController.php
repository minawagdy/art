<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index(){

        $setting=Setting::first();
        return view('admin.setting.index',compact('setting'));

    }

    public function update(Request $request)
    {
        $request->validate([
            'title_en' => 'required|max:200',
            'title_ar' => 'required|max:200',
            'description_en' => 'required',
            'description_ar' => 'required',
            'keyword_en' => 'required',
            'keyword_ar' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'main_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    // dd($request->all());
        // Retrieve the model instance from the database
        $setting = Setting::find(1);
    
        // Check if logo or main_image fields are not empty, then update them
        if ($request->hasFile('logo')) {

            $logo = $request->file('logo');

            // Store the uploaded logo in the 'logos' directory within the storage folder
            $logoPath = $logo->store('logos', 'public');
    
            // Update the 'logo' field in the database with the path to the uploaded logo
            $setting->logo = $logoPath;      
          }
    
        if ($request->hasFile('main_image')) {

            $main_image = $request->file('main_image');

            // Store the uploaded logo in the 'logos' directory within the storage folder
            $mainPath = $main_image->store('main_image', 'public');
    
            // Update the 'logo' field in the database with the path to the uploaded logo
            $setting->main_image = $mainPath;    
                }
    
        // Update other fields
        $setting->title_en = $request->input('title_en');
        $setting->title_ar = $request->input('title_ar');
        $setting->description_en = $request->input('description_en');
        $setting->description_ar = $request->input('description_ar');
        $setting->keyword_en = $request->input('keyword_en');
        $setting->keyword_ar = $request->input('keyword_ar');
    
        // Save the updated model to the database
        $setting->save();
        

        if ($setting->save()) {
            return back()->with('success', 'updated successfully.');
        }
    
        return back()->with('error', 'Failed to update record.');
    
        // Redirect or return a response as needed
    }
   



}
