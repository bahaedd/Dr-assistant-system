<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Return the dashboard view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $patients = Patient::all()->count();
        $appointments = Appointment::orderBy('id', 'desc')->take(5)->get();
        return view('dash', compact('patients', 'appointments'));
    }
}
