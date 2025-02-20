<?php

use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ProfesseurController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScheduleController;

Route::get('/', function () {
    return view('index');
});

Route::get('/sendmail', [EmailController::class, 'SendCheckEmail'])->middleware('auth')->name('sendmail');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/reservation', [ProfesseurController::class, 'index'])->name('reservation');
    Route::post('createappointment', [AppointmentsController::class, 'createAppointments']);
    Route::get('load_schedule', [ScheduleController::class, 'load_schedule'])->name('load_schedule');
    Route::delete('/schedule/{schedule}', [ScheduleController::class, 'destroy']);
    Route::get('list', [ScheduleController::class, 'ScheduleCalendar'])->name('schedule.list');
    Route::delete('/appointments/{appointment}', [AppointmentsController::class, 'destroy']);
    Route::get('calendar', [ScheduleController::class, 'index'])->name('schedules.index');
    Route::post('schedules', [ScheduleController::class, 'store']);
    Route::delete('schedules/{schedule}', [ScheduleController::class, 'destroy']);
    Route::middleware(['auth'])->get('schedule_load', [ScheduleController::class, 'load_schedule'])->name('schedule_load');
    Route::get('/booking', [AppointmentsController::class, 'index'])->name('booking');

    Route::get('profil', action: function () {return view(view: 'profil');})->name('profil');

});

