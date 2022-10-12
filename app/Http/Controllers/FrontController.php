<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Doctor;
use App\Models\ListPrice;
use App\Models\Reservation;
use App\Models\Specialty;
use App\Models\Workdays;
use Exception;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function home()
    {
        $specialties = Specialty::all();
        return view('front.welcome', compact('specialties'));
    }

    public function showReservation()
    {
        return view('front.reservations');
    }

    public function about()
    {
        return view('front.about');
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function addContact(Request $request)
    {
        $rules = [
            'name' => 'required',
            'phone' => 'required|numeric|digits:11',
            'subject' => 'required',
            'message' => 'required',
        ];

        $validate = $this->validate($request, $rules);

        try {

            Contact::create($request->all());
            toastr()->success(trans('main.data_added_successfully'));
            return back();

        } catch (Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function specialties()
    {
        $specialties = Specialty::all();
        return view('front.specialties', compact('specialties'));
    }

    public function doctors()
    {
        $doctors = Doctor::all();
        return view('front.doctors', compact('doctors'));
    }

    public function findDoctor()
    {
        $doctors = Doctor::orderBy('id', 'desc')->paginate(6);
        $specialties = Specialty::all();
        return view('front.search', compact('specialties', 'doctors'));
    }

    public function search(Request $request)
    {
        if (!empty($request->specialty_id) && !empty($request->keyword)) {

            $doctors = Doctor::where('specialty_id', $request->specialty_id)
                ->where('name', 'LIKE', '%' . $request->keyword . '%')->paginate(6);

        } elseif (!empty($request->specialty_id)) {

            $doctors = Doctor::where('specialty_id', $request->specialty_id)->paginate(6);

        } elseif (!empty($request->keyword)) {

            $doctors = Doctor::where('name', 'LIKE', '%' . $request->keyword . '%')->paginate(6);

        } else {

            $doctors = Doctor::latest()->paginate(6);

        }

        $specialties = Specialty::all();
        return view('front.search', compact('doctors', 'specialties'));
    }

    public function schedule()
    {
        $specialties = Specialty::paginate(2);
        return view('front.schedule', compact( 'specialties'));
    }

    public function reservation(Request $request)
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

            Reservation::create([
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

            toastr()->success(trans('main.reservation_successfully'));
            return redirect()->back();

        } catch (Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
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
