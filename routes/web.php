<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Front\FrontHomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', [FrontHomeController::class, 'index'])
    ->name('home');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', fn () => Inertia::render('Dashboard'))->name('dashboard');
    Route::resource('appointments', AppointmentController::class);
    Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
    Route::resource('services', ServiceController::class);
   // Route::get('/users', fn () => Inertia::render('Users/Index'))->name('users');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::resource('clients', ClientController::class);  

    Route::get('/settings', fn () => Inertia::render('Settings/Index'))->name('settings');

   Route::get('/homePage', [HomeController::class, 'index'])->name('homepage.index');

    // Affiche le formulaire d'édition d'une section
    Route::get('/homePage/{sectionKey}/edit', [HomeController::class, 'edit'])->name('homepage.edit');

   
    // Add admin.homepage.update route for Ziggy compatibility
    Route::put('/admin/homePage/{sectionKey}/update', [HomeController::class, 'update'])->name('admin.homepage.update');
    
    Route::get('/homePage/create', [HomeController::class, 'create'])->name('homepage.create');
    Route::post('/homePage', [HomeController::class, 'store'])->name('homepage.store');


    
});

require __DIR__.'/auth.php';
