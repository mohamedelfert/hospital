<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Examination;
use Exception;
use Illuminate\Http\Request;

class ExaminationController extends Controller
{
    public function index(Request $request)
    {
        $title = trans('main.examinations');
        $examinations = Examination::when($request->search, function ($q) use ($request) {
            return $q->where('name->ar', 'LIKE', '%' . $request->search . '%')
                ->orWhere('name->en', 'LIKE', '%' . $request->search . '%')
                ->orWhere('notes', 'LIKE', '%' . $request->search . '%');
        })->latest()->paginate(10);
        return view('dashboard.examinations.index', compact('title', 'examinations'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:examinations,name->ar',
            'name_en' => 'required|unique:examinations,name->en',
        ];
        $validate = $this->validate($request, $rules);

        try {

            Examination::create([
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

    public function show(Examination $examination)
    {
        //
    }

    public function edit(Examination $examination)
    {
        //
    }

    public function update(Request $request, Examination $examination)
    {
        $rules = [
            'name' => 'required|unique:examinations,name->ar,' . $examination->id,
            'name_en' => 'required|unique:examinations,name->en,' . $examination->id,
        ];
        $validate = $this->validate($request, $rules);

        try {

            $examination->update([
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

    public function destroy(Examination $examination)
    {
        $examination->delete();
        toastr()->success(trans('main.data_deleted_successfully'));
        return back();
    }
}
