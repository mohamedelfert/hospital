<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class SettingController extends Controller
{
    public function index()
    {
        $title = trans('main.settings');
        return view('dashboard.settings.settings',compact('title'));
    }

    public function update(Request $request,Setting $setting)
    {
        $validation = Validator::make($request->all(), [
            'site_name_ar' => 'required',
            'site_name_en' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:11',
            'address' => 'required',
            'logo' => 'sometimes|nullable|image|mimes:png,jpg,jpeg,gif',
            'icon' => 'sometimes|nullable|image|mimes:png,jpg,jpeg,gif',
            'facebook' => 'required',
            'twitter' => 'required',
            'instagram' => 'required',
            'main_lang' => 'required|in:arabic,english',
            'status' => 'required|in:open,close',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $data = $request->except(['logo', 'icon']);

        if ($request->logo){
            if ($setting->logo != 'logo.jpg'){
                Storage::disk('public_uploads')->delete('/setting_images/' . $setting->logo);
            }
            Image::make($request->logo)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('/uploads/setting_images/' . $request->logo->getClientOriginalName()));
            $data['logo'] = $request->logo->getClientOriginalName();
        }

        if ($request->icon){
            if ($setting->icon != 'icon.jpg'){
                Storage::disk('public_uploads')->delete('/setting_images/' . $setting->icon);
            }
            Image::make($request->icon)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('/uploads/setting_images/' . $request->icon->getClientOriginalName()));
            $data['icon'] = $request->icon->getClientOriginalName();
        }

        $setting->update($data);
        toastr()->warning(trans('main.data_updated_successfully'));
        return redirect()->back();
    }
}
