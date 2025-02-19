<?php

use App\Http\Controllers\AppointmentsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScheduleController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', function () {
    return view('index');
});

Route::get('/booking', [AppointmentsController::class, 'index']);

Route::get('/calendar', function () {
    return view('calendar');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get(uri : '/modal', action: function () {
    return view(view: 'modal');
});




Route::middleware(['auth'])->get('calendar', [ScheduleController::class, 'index'])->name('schedules.index');
Route::middleware(['auth'])->post('schedules', [ScheduleController::class, 'store']);
Route::middleware(['auth'])->delete('schedules/{schedule}', [ScheduleController::class, 'destroy']);
