<?php

use App\Http\Controllers\AppointmentsController;
use Illuminate\Support\Facades\Route;
use App\Models\Schedule;

Route::middleware(['role:admin'])->group(function () {
    Route::get('/booking', [AppointmentsController::class, 'index'])->name('booking');
});



Route::middleware(['role:teacher'])->group(function () {
    Route::get('/appointments', [AppointmentsController::class, 'index'])->name('appointments.index');
    Route::delete('/appointments/{id}', [AppointmentsController::class, 'destroy'])->name('appointments.destroy');
    Route::get('/calendar', function () {
        return view('calendar');
    })->name('calendar');
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', function () {
    return view('index');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get(uri : '/modal', action: function () {
    return view(view: 'modal');
});



Route::get('/test', function () {
    $schedules = Schedule::with('teacher')->get();

    return view('test_schedules', compact('schedules'));
});


