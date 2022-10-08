<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use App\Models\Doctor;
use App\Models\Specialty;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class DoctorController extends Controller
{
    public function index(Request $request)
    {
        $title = trans('main.doctors');
        $doctors = Doctor::when($request->search, function ($q) use ($request) {
            return $q->where('name->ar', 'LIKE', '%' . $request->search . '%')
                ->orWhere('name->en', 'LIKE', '%' . $request->search . '%')
                ->orWhere('gender', 'LIKE', '%' . $request->search . '%')
                ->orWhere('phone', 'LIKE', '%' . $request->search . '%');
        })->latest()->paginate(10);
        $specialties = Specialty::all();
        return view('dashboard.doctors.index', compact('title', 'doctors', 'specialties'));
    }

    public function create()
    {
        //
    }

    public function store(DoctorRequest $request)
    {
        $validate = $request->validated();

        try {

            $data = $request->except(['name', 'name_en', 'image']);
            $data['name'] = ['ar' => $request->name, 'en' => $request->name_en];

            if ($request->image) {
                Image::make($request->image)->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/doctors_images/' . $request->image->hashName()));

                $data['image'] = $request->image->hashName();
            }

            Doctor::create($data);

            toastr()->success(trans('main.data_added_successfully'));
            return redirect()->back();

        } catch (Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function show(Doctor $doctor)
    {
        $title = trans('main.doctors');
        return view('dashboard.doctors.show', compact('title', 'doctor'));
    }

    public function edit(Doctor $doctor)
    {
        //
    }

    public function update(Request $request, Doctor $doctor)
    {
        $rules = [
            'name' => 'required|unique:doctors,name->ar,' . $doctor->id,
            'name_en' => 'required|unique:doctors,name->en,' . $doctor->id,
            'phone' => 'required|numeric|unique:doctors,phone,' . $doctor->id,
            'email' => 'required|email|unique:doctors,email,' . $doctor->id,
            'address' => 'required',
            'gender' => 'required|in:male,female',
            'specialty_id' => 'required',
            'image' => 'sometimes|nullable|image|mimes:png,jpg,jpeg,gif'
        ];
        $validate = $this->validate($request, $rules);

        try {

            $data = $request->except(['name', 'name_en', 'image']);
            $data['name'] = ['ar' => $request->name, 'en' => $request->name_en];

            if ($request->image) {
                if ($doctor->image != 'default.png') {
                    Storage::disk('public_uploads')->delete('/doctors_images/' . $doctor->image);
                }

                Image::make($request->image)->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/doctors_images/' . $request->image->hashName()));

                $data['image'] = $request->image->hashName();
            }

            $doctor->update($data);

            toastr()->success(trans('main.data_updated_successfully'));
            return redirect()->back();

        } catch (Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function destroy(Doctor $doctor)
    {
        if ($doctor->image != 'default.png') {
            Storage::disk('public_uploads')->delete('/doctors_images/' . $doctor->image);
        }
        $doctor->delete();
        toastr()->success(trans('main.data_deleted_successfully'));
        return redirect()->back();
    }
}
