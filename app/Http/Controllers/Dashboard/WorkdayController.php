<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Examination;
use App\Models\Workdays;
use Exception;
use Illuminate\Http\Request;

class WorkdayController extends Controller
{
    public function index(Request $request)
    {
        $title = trans('main.workdays');
        $workdays = Workdays::when($request->search, function ($q) use ($request) {
            return $q->where('day->ar', 'LIKE', '%' . $request->search . '%')
                ->orWhere('day->en', 'LIKE', '%' . $request->search . '%');
        })->latest()->paginate(10);
        $doctors = Doctor::all();
        return view('dashboard.workdays.index', compact('title', 'workdays', 'doctors'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        /**
         *  add "workdays_list.*." before column name if you use array to add more than 1 filed .
         */
        $rules = [
            'workdays_list.*.day' => 'required',
            'workdays_list.*.doctor_id' => 'required',
        ];
        $validate = $this->validate($request, $rules);

        $workdays = $request->workdays_list;

        try {

            /**
             * this foreach use when add more than 1 workday in one form .
             */
            foreach ($workdays as $workday) {

                if ($workday['day'] === 'saturday') {
                    $day = 'السبت';
                } else if ($workday['day'] === 'sunday') {
                    $day = 'الاحد';
                } else if ($workday['day'] === 'monday') {
                    $day = 'الاثنين';
                } else if ($workday['day'] === 'tuesday') {
                    $day = 'الثلاثاء';
                } else if ($workday['day'] === 'wednesday') {
                    $day = 'الاربعاء';
                } else if ($workday['day'] === 'thursday') {
                    $day = 'الخميس';
                } else if ($workday['day'] === 'friday') {
                    $day = 'الجمعه';
                }

                Workdays::create([
                    'day' => [
                        'ar' => $day,
                        'en' => $workday['day'],
                    ],
                    'doctor_id' => $workday['doctor_id'],
                ]);
            }

            toastr()->success(trans('main.data_added_successfully'));
            return back();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function show(Workdays $workdays)
    {
        //
    }

    public function edit(Workdays $workdays)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'day' => 'required',
            'doctor_id' => 'required',
        ];
        $validate = $this->validate($request, $rules);

        $workdays = Workdays::findOrFail($id);

        try {

            if ($request->day === 'saturday') {
                $workday = 'السبت';
            } else if ($request->day === 'sunday') {
                $workday = 'الاحد';
            } else if ($request->day === 'monday') {
                $workday = 'الاثنين';
            } else if ($request->day === 'tuesday') {
                $workday = 'الثلاثاء';
            } else if ($request->day === 'wednesday') {
                $workday = 'الاربعاء';
            } else if ($request->day === 'thursday') {
                $workday = 'الخميس';
            } else if ($request->day === 'friday') {
                $workday = 'الجمعه';
            }

            $workdays->update([
                'day' => [
                    'ar' => $workday,
                    'en' => $request->day,
                ],
                'doctor_id' => $request->doctor_id,
            ]);

            toastr()->success(trans('main.data_updated_successfully'));
            return back();

        } catch (Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        Workdays::findOrFail($id)->delete();
        toastr()->success(trans('main.data_deleted_successfully'));
        return back();
    }
}
