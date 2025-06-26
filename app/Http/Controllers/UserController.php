<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Inertia\Inertia;

class UserController extends Controller
{
    // Affiche la liste des utilisateurs avec pagination
    public function index()
    {
        $users = User::select('id', 'name', 'email', 'role', 'is_active', 'last_login_at')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
           // dd($users);
         return Inertia::render('Users/Index', [
            'users' => $users ]);
         }
        

    
    // Affiche le profil de l'utilisateur connecté
    public function profile()
    {
        return Inertia::render('Profile/Index', [
            'user' => auth()->user(),
        ]);
    }

    // Met à jour le profil de l'utilisateur connecté
    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
        ]);

        auth()->user()->update($validated);

        return redirect()->back()->with('success', 'Profil mis à jour avec succès.');
    }
}
