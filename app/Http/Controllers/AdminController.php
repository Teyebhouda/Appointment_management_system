<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Http\Request;

class AdminController extends Controller
{
public function index()
{
    // This method can be used to display the admin dashboard or any admin-related content
   return Inertia::render('Admin/Dashboard', [
        'users' => \App\Models\User::all(), // Example: Fetch all users for admin view
    ]);
}
}