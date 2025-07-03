<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;


class AppointmentController extends Controller
{
    // Liste tous les rendez-vous avec pagination, sans restriction utilisateur
    public function index()
    {
        $appointments = Appointment::orderBy('appointment_time', 'desc')->with('service','user')->paginate(10);

        return Inertia::render('Admin/Appointments/Index', [
            'appointments' => $appointments,
        ]);
    }

    // Affiche le formulaire de création
    public function create()
    {
        
       
        // Si l'utilisateur n'est pas admin, on peut restreindre les services ou les utilisateurs affichés
        if (!auth()->user()->isAdmin()) {
            // Par exemple, on peut ne pas afficher les services ou utilisateurs non associés à l'utilisateur connecté
             $services = Service::where('user_id', auth()->id())->get();
            $users = User::where('id', auth()->id())->get(); // Limite aux utilisateurs associés à l'utilisateur connecté
        }
        else {
            // Si l'utilisateur est admin, on peut récupérer tous les services et utilisateurs
            $services = Service::all();
            $users = User::all(); // Récupère tous les utilisateurs pour le formulaire de création
        }

        return Inertia::render('Admin/Appointments/Create', [
            'services' => $services,
            'users' => $users, // Récupère tous les utilisateurs pour le formulaire de création
        ]);
    }

    // Enregistre un nouveau rendez-vous
    public function store(Request $request)
    {
        
        $validated=$request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'appointment_time' => 'required|date|after:now',
            'service_id' => 'nullable|exists:services,id', // Validation pour le service
            'status' => 'required|string|in:pending,confirmed,cancelled', // Validation pour le statut
            'user_id' => 'required|exists:users,id', // Validation pour l'utilisateur
       
        ]);

        Appointment::create($validated);

        return redirect()->route('appointments.index')->with('success', 'Rendez-vous créé avec succès.');
    }

    // Affiche le formulaire d'édition d'un rendez-vous (admin a accès à tous)
    // Récupère la liste des services pour le formulaire d'édition
    public function edit(Appointment $appointment)
    {
        // Vérifie si l'utilisateur est admin ou s'il est le propriétaire du rendez-vous
        if (!auth()->user()->isAdmin() && auth()->id() !== $appointment->user_id) {
            return redirect()->route('appointments.index')->with('error', 'Vous n\'êtes pas autorisé à modifier ce rendez-vous.');
        }
        // Si l'utilisateur est admin, on peut récupérer tous les services et utilisateurs
        if (auth()->user()->isAdmin()) {
            $services = Service::all();
            $users = User::all(); // Récupère tous les utilisateurs pour le formulaire d'édition
        } else {
            // Si l'utilisateur n'est pas admin, on peut restreindre les services ou les utilisateurs affichés
            $services = Service::where('user_id', auth()->id())->get(); // Limite aux services associés à l'utilisateur connecté
            $users = User::where('id', auth()->id())->get(); // Limite aux utilisateurs associés à l'utilisateur connecté
        }
       

        return Inertia::render('Admin/Appointments/Edit', [
            'appointment' => $appointment,
            'services' => $services,
            'users' => $users, // Récupère tous les utilisateurs pour le formulaire d'édition
            'selectedService' => $appointment->service_id, // Service sélectionné pour l'édition
            'selectedUser' => $appointment->user_id, // Utilisateur sélectionné pour l'édition
            'statusOptions' => [
                'pending' => 'En attente',
                'confirmed' => 'Confirmé',
                'cancelled' => 'Annulé',
            ],
            'selectedStatus' => $appointment->status, // Statut sélectionné pour l'édition
        ]);
    }
   

    // Met à jour un rendez-vous
    public function update(Request $request, Appointment $appointment)
    {
        if (!auth()->user()->isAdmin() && auth()->id() !== $appointment->user_id)
         {
    return redirect()->route('appointments.index')->with('error', 'Action non autorisée.');
   }

        $validated=$request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'appointment_time' => 'required|date|after:now',
            'service_id' => 'nullable|exists:services,id', // Validation pour le service
            'status' => 'required|string|in:pending,confirmed,cancelled', // Validation pour le statut
            'user_id' => 'required|exists:users,id', // Validation pour l'utilisateur

        ]);

        $appointment->update($validated);

        return redirect()->route('appointments.index')->with('success', 'Rendez-vous mis à jour.');
    }

    // Supprime un rendez-vous
    public function destroy(Appointment $appointment)
    {
        if (!auth()->user()->isAdmin() && auth()->id() !== $appointment->user_id) {
    return redirect()->route('appointments.index')->with('error', 'Action non autorisée.');
   }

        $appointment->delete();

        return redirect()->route('appointments.index')->with('success', 'Rendez-vous supprimé.');
    }

 
}
