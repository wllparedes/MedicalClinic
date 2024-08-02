<?php

use App\Http\Controllers\LoginController;
use App\Models\Appointment;
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

        Route::get('/categories', function () {
            return view('admin.categories.index');
        })->name('categories');

        Route::get('/products', function () {
            return view('admin.products.index');
        })->name('products');
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

        Route::get('/appointments', function () {
            return view('receptionist.appointments.index');
        })->name('appointments');

        Route::get('/appointments/{appointment}', function (Appointment $appointment) {
            return view('receptionist.appointments.show', compact('appointment'));
        })->name('appointments.show');
    });

    Route::middleware(['check.role:doctor'])->prefix('doctor')->name('doctor.')->group(function () {

        Route::get('dashboard', function () {
            return view('doctor.dashboard.index');
        })->name('dashboard');

        Route::get('appointments', function () {
            return view('doctor.appointments.index');
        })->name('appointments');

        Route::get('appointments/view/{appointment}', function (Appointment $appointment) {
            return view('doctor.appointments.show', compact('appointment'));
        })->name('appointments.show');

        Route::get('patients', function () {
            return view('doctor.patients.index');
        })->name('patients');
    });

    // PATIENTS

    Route::prefix('patient')->name('patient.')->group(function () {
        Route::get('/dashboard', function () {
            return view('patient.dashboard.index');
        })->name('dashboard');

        Route::get('/appointments', function () {
            return view('patient.appointments.index');
        })->name('appointments');
    });
});
