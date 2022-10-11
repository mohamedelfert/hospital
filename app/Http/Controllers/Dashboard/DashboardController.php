<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Reservation;
use App\Models\Specialty;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $title = trans('main.dashboard');
        $doctors = Doctor::latest()->paginate(6);
        $reservations = Reservation::latest()->paginate(6);
        return view('dashboard.welcome', compact('title', 'doctors', 'reservations'));
    }
}
