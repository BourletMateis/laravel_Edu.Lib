<?php

use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\Auth\teacherController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', function () {
    return view('index');
});

Route::get('/booking', [AppointmentsController::class, 'index']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/booking', [AppointmentsController::class, 'index'])->name('booking');
Route::get('/reservation', [teacherController::class, 'index'])->name('reservation');
Route::get('/calendar', function () {
    return view('calendar');
});

Route::delete('appointments', [AppointmentsController::class, 'destroy']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get(uri : '/modal', action: function () {
    return view(view: 'modal');
});




Route::middleware(['auth'])->get('calendar', [ScheduleController::class, 'index'])->name('schedules.index');
Route::middleware(['auth'])->post('schedules', [ScheduleController::class, 'store']);
Route::middleware(['auth'])->delete('schedules/{schedule}', [ScheduleController::class, 'destroy']);

Route::get('list', [ScheduleController::class, 'ScheduleCalendar']);
Route::post('/addappointments', [AppointmentsController::class, 'createAppointments']);

Route::get('/schedule-view', [ScheduleController::class, 'showSchedules']);
