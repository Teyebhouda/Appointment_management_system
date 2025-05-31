<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AppointmentController extends Controller
{
    // Liste tous les rendez-vous avec pagination, sans restriction utilisateur
    public function index()
    {
        $appointments = Appointment::orderBy('appointment_time', 'desc')->paginate(10);

        return Inertia::render('Appointments/Index', [
            'appointments' => $appointments,
        ]);
    }

    // Affiche le formulaire de création
    public function create()
    {
        return Inertia::render('Appointments/Create');
    }

    // Enregistre un nouveau rendez-vous
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'appointment_time' => 'required|date|after:now',
        ]);

        Appointment::create($request->only('title', 'description', 'appointment_time'));

        return redirect()->route('appointments.index')->with('success', 'Rendez-vous créé avec succès.');
    }

    // Affiche le formulaire d'édition d'un rendez-vous (admin a accès à tous)
    public function edit(Appointment $appointment)
    {
        return Inertia::render('Appointments/Edit', [
            'appointment' => $appointment,
        ]);
    }

    // Met à jour un rendez-vous
    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'appointment_time' => 'required|date|after:now',
        ]);

        $appointment->update($request->only('title', 'description', 'appointment_time'));

        return redirect()->route('appointments.index')->with('success', 'Rendez-vous mis à jour.');
    }

    // Supprime un rendez-vous
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('appointments.index')->with('success', 'Rendez-vous supprimé.');
    }
}
