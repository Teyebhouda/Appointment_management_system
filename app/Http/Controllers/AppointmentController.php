<?php
namespace App\Http\Controllers;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Inertia\Inertia;
class AppointmentController extends Controller
{
    public function index()
{
    return Inertia::render('Appointments/Index', [
        'appointments' => Appointment::where('user_id', auth()->id())->get(),
    ]);
}

public function create()
{
    return Inertia::render('Appointments/Create');
}

public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'appointment_time' => 'required|date',
    ]);

    Appointment::create([
        'user_id' => auth()->id(),
        'title' => $request->title,
        'description' => $request->description,
        'appointment_time' => $request->appointment_time,
    ]);

    return redirect()->route('appointments.index')->with('success', 'Appointment created.');
}

}