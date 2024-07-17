<?php

use App\Http\Controllers\LoginController;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Facades\Route;


Route::get('/', [LoginController::class, '_index'])->name('index');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {

    // USERS
    Route::middleware(['check.role:admin'])->prefix('admin')->name('admin.')->group(function () {

        // ADMIN

        Route::get('/dashboard', function () {
            return view('admin.dashboard.index');
        })->name('dashboard');

        Route::get('/staff', function () {
            return view('admin.staff.index');
        })->name('staff');

        Route::get('staff/{user:slug}', function (User $user) {
            return view('admin.staff.show', compact('user'));
        })->name('staff.show');

        Route::get('/patients', function () {
            return view('admin.patients.index');
        })->name('patients');

        Route::get('/patients/{patient:slug}', function (Patient $patient) {
            return view('admin.patients.show', compact('patient'));
        })->name('patients.show');
    });

    Route::middleware(['check.role:receptionist'])->prefix('receptionist')->name('receptionist.')->group(function () {

        // RECEPTIONIST

        Route::get('/dashboard', function () {
            return view('receptionist.dashboard.index');
        })->name('dashboard');

        Route::get('/patients', function () {
            return view('receptionist.patients.index');
        })->name('patients');

        Route::get('/patients/{patient:slug}', function (Patient $patient) {
            return view('receptionist.patients.show', compact('patient'));
        })->name('patients.show');

        Route::get('/doctors', function () {
            return view('receptionist.doctors.index');
        })->name('doctors');

        Route::get('/doctors/{doctor:slug}', function (User $doctor) {
            return view('receptionist.doctors.show', compact('doctor'));
        })->name('doctors.show');

    });
});
