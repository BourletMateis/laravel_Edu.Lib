<?php

use Illuminate\Support\Facades\Route;
use App\Models\Schedule;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/test', function () {
    $schedules = Schedule::with('teacher')->get();

    return view('test_schedules', compact('schedules'));
});
