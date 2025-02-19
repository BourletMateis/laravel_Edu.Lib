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
Route::get('/calendar', action: function () {
    return view('calendar');
});

Route::get('/reservation', [ProfesseurController::class, 'index'])->name('reservation');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::delete('/appointments/{appointment}', [AppointmentsController::class, 'destroy']);
Route::delete('/schedule/{schedule}', [ScheduleController::class, 'destroy']);

Route::get(uri : '/modal', action: function () {
    return view(view: 'modal');
});




Route::middleware(['auth'])->get('calendar', [ScheduleController::class, 'index'])->name('schedules.index');
Route::middleware(['auth'])->post('schedules', [ScheduleController::class, 'store']);
Route::middleware(['auth'])->delete('schedules/{schedule}', [ScheduleController::class, 'destroy']);


Route::middleware(['auth'])->get('schedule_load', [ScheduleController::class, 'load_schedule'])->name('schedule_load');
