<?php

use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\ProfesseurController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScheduleController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', function () {
    return view('index');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/booking', [AppointmentsController::class, 'index'])->name('booking');

Route::get('/reservation', [ProfesseurController::class, 'index'])->name('reservation');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::delete('/appointments/{appointment}', [AppointmentsController::class, 'destroy']);

Route::get(uri : '/modal', action: function () {
    return view(view: 'modal');
});

// Must be logged routes
Route::group(['middleware' => 'auth'], function () {
    Route::get('calendar', [ScheduleController::class, 'index'])->name('schedules.index');
    Route::post('schedules', [ScheduleController::class, 'store']);
    Route::delete('schedules/{schedule}', [ScheduleController::class, 'destroy']);
});

