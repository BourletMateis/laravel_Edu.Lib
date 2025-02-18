<?php

use App\Http\Controllers\AppointmentsController;
use Illuminate\Support\Facades\Route;
use App\Models\Schedule;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', function () {
    return view('index');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/booking', [AppointmentsController::class, 'index']);
Route::get('/calendar', function () {
    return view('calendar');
});

Route::get(uri : '/modal', action: function () {
    return view(view: 'modal');
});


Route::get('/test', function () {
    $schedules = Schedule::with('teacher')->get();

    return view('test_schedules', compact('schedules'));
});


