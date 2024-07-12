<?php

use App\Http\Controllers\LoginController;
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
        
    });
});
