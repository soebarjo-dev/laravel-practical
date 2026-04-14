<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/sign-in', [AuthController::class, 'IndexSignIn'])->name('sign-in.index');
Route::post('/sign-in', [AuthController::class, 'ProcessSignIn'])->name('sign-in.process');
Route::get('/register', [AuthController::class, 'IndexRegister'])->name('register.index');
Route::post('/register', [AuthController::class, 'ProcessRegister'])->name('register.process');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');