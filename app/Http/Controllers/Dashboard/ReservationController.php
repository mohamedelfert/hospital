<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Examination;
use App\Models\ListPrice;
use App\Models\Reservation;
use App\Models\Specialty;
use App\Models\Workdays;
use Exception;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $title = trans('main.reservations');
        $reservations = Reservation::when($request->search, function ($q) use ($request) {
            return $q->where('name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('phone', 'LIKE', '%' . $request->search . '%')
                ->orWhere('address', 'LIKE', '%' . $request->search . '%')
                ->orWhere('age', 'LIKE', '%' . $request->search . '%')
                ->orWhere('gender', 'LIKE', '%' . $request->search . '%');
        })->latest()->paginate(10);
        $specialties = Specialty::all();
        $examinations = Examination::all();
        return view('dashboard.reservations.index',
            compact('title', 'reservations', 'specialties', 'examinations'));
    }

    public function create()
    {
        $title = trans('main.reservation_create');
        $specialties = Specialty::all();
        $examinations = Examination::all();
        return view('dashboard.reservations.create', compact('title', 'specialties', 'examinations'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'phone' => 'required|numeric|digits:11',
            'address' => 'required',
            'age' => 'required',
            'gender' => 'required|in:male,female',
            'examination_id' => 'required',
            'specialty_id' => 'required',
            'doctor_id' => 'required',
            'day_id' => 'required',
            'date' => 'required',
        ];

        $validate = $this->validate($request, $rules);

        $prices = ListPrice::where('specialty_id', $request->specialty_id)
            ->where('examination_id', $request->examination_id)
            ->get();
        foreach ($prices as $price) {
            $price = $price->price;
        }

        try {

            $reservation = Reservation::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'age' => $request->age,
                'gender' => $request->gender,
                'examination_id' => $request->examination_id,
                'specialty_id' => $request->specialty_id,
                'doctor_id' => $request->doctor_id,
                'day_id' => $request->day_id,
                'date' => $request->date,
                'price' => $price,
                'code' => random_int(1111, 9999),
                'is_completed' => 0,
            ]);

            toastr()->success(trans('main.data_added_successfully'));
            return redirect()->route('dashboard.reservations.show', $reservation->id);

        } catch (Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function show(Reservation $reservation)
    {
        $title = trans('main.reservation_details');
        return view('dashboard.reservations.show', compact('title', 'reservation'));
    }

    public function edit(Reservation $reservation)
    {
        $title = trans('main.reservation_edit');
        $specialties = Specialty::all();
        $examinations = Examination::all();
        return view('dashboard.reservations.edit', compact('title', 'reservation', 'specialties', 'examinations'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $rules = [
            'name' => 'required',
            'phone' => 'required|numeric|digits:11',
            'address' => 'required',
            'age' => 'required',
            'gender' => 'required|in:male,female',
            'examination_id' => 'required',
            'specialty_id' => 'required',
            'doctor_id' => 'required',
            'day_id' => 'required',
            'date' => 'required',
        ];

        $validate = $this->validate($request, $rules);

        $prices = ListPrice::where('specialty_id', $request->specialty_id)
            ->where('examination_id', $request->examination_id)
            ->get();
        foreach ($prices as $price) {
            $price = $price->price;
        }

        try {

            $reservation->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'age' => $request->age,
                'gender' => $request->gender,
                'examination_id' => $request->examination_id,
                'specialty_id' => $request->specialty_id,
                'doctor_id' => $request->doctor_id,
                'day_id' => $request->day_id,
                'date' => $request->date,
                'price' => $price,
            ]);

            toastr()->success(trans('main.data_updated_successfully'));
            return redirect()->route('dashboard.reservations.index');

        } catch (Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        toastr()->success(trans('main.data_deleted_successfully'));
        return back();
    }

    public function complete($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['is_completed' => 1]);
        toastr()->success(trans('main.data_updated_successfully'));
        return back();
    }

    public function getDoctors(Request $request)
    {
        return Doctor::where('specialty_id', $request->id)->pluck('name', 'id');
    }

    public function getDays(Request $request)
    {
        return Workdays::where('doctor_id', $request->id)->pluck('day', 'id');
    }
}
