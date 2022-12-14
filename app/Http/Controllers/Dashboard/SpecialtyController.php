<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SpecialtyRequest;
use App\Models\Specialty;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SpecialtyController extends Controller
{
    public function index(Request $request)
    {
        $title = trans('main.specialties');
        $specialties = Specialty::when($request->search, function ($q) use ($request) {
            return $q->where('name->ar', 'LIKE', '%' . $request->search . '%')
                ->orWhere('name->en', 'LIKE', '%' . $request->search . '%')
                ->orWhere('notes', 'LIKE', '%' . $request->search . '%');
        })->latest()->paginate(10);
        return view('dashboard.specialties.index', compact('title', 'specialties'));
    }

    public function create()
    {
        //
    }

    public function store(SpecialtyRequest $request)
    {
        $validate = $request->validated();

        try {

            Specialty::create([
                'name' => [
                    'ar' => $request->name,
                    'en' => $request->name_en,
                ],
                'notes' => $request->notes,
            ]);

            toastr()->success(trans('main.data_added_successfully'));
            return back();

        } catch (Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function show(Specialty $specialty)
    {
        //
    }

    public function edit(Specialty $specialty)
    {
        //
    }

    public function update(Request $request, Specialty $specialty)
    {
        $rules = [
            'name' => 'required|unique:specialties,name->ar,' . $specialty->id,
            'name_en' => 'required|unique:specialties,name->en,' . $specialty->id,
            // Or
//            'name' => 'required|' . Rule::unique('specialties', 'name->ar')->ignore($this->id),
//            'name_en' => 'required|' . Rule::unique('specialties', 'name->en')->ignore($this->id),
        ];
        $validate = $this->validate($request, $rules);

        try {

            $specialty->update([
                'name' => [
                    'ar' => $request->name,
                    'en' => $request->name_en,
                ],
                'notes' => $request->notes,
            ]);

            toastr()->success(trans('main.data_updated_successfully'));
            return back();

        } catch (Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function destroy(Specialty $specialty)
    {
        $specialty->delete();
        toastr()->success(trans('main.data_deleted_successfully'));
        return back();
    }
}
