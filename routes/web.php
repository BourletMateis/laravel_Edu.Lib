<?php

use App\Http\Controllers\AppointmentsController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/booking', [AppointmentsController::class, 'index']);
Route::get('/calendar', function () {
    return view('calendar');
});

