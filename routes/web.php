<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Master\{
    UserController,
    UnitController,
    ProductController,
    CustomerController,
};
use Illuminate\Support\Facades\Route;

// NON-AUTH

Route::get('/sign-in', [AuthController::class, 'IndexSignIn'])->name('sign-in.index');
Route::post('/sign-in', [AuthController::class, 'ProcessSignIn'])->name('sign-in.process');
Route::get('/register', [AuthController::class, 'IndexRegister'])->name('register.index');
Route::post('/register', [AuthController::class, 'ProcessRegister'])->name('register.process');

// AUTH REQUIRED
Route::middleware('custom.authentication')->group(function(){
    Route::get('/', function(){
        return redirect()->route('dashboard.index');
    });
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::name('master-')->group(function(){
        Route::prefix('master')->group(function(){
            Route::resource('users', UserController::class);
        });

        Route::prefix('master')->group(function(){
            Route::resource('units', UnitController::class);
        });

        Route::prefix('master')->group(function(){
            Route::resource('products', ProductController::class);
        });

        Route::prefix('master')->group(function(){
            Route::resource('customers', CustomerController::class);
        });
    });
    Route::prefix('transactions')->group(function(){
        Route::get('/', [TransactionController::class, 'index'])->name('transactions.index');
        Route::get('/create', [TransactionController::class, 'create'])->name('transactions.create');
        Route::get('/{id}', [TransactionController::class, 'detail'])->name('transactions.detail');
        Route::post('/', [TransactionController::class, 'store'])->name('transactions.store');
    });
    Route::get('/reports', [DashboardController::class, 'index'])->name('reports.index');
});
