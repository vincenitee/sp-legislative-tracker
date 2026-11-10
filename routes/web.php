<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrdinanceController;
use App\Http\Controllers\PublicSearchController;
use App\Http\Controllers\ResolutionController;
use Illuminate\Support\Facades\Route;

// Public Legislative Search Routes
Route::get('/', [PublicSearchController::class, 'index'])->name('public.search');
Route::get('/records/ordinance/{ordinance}', [PublicSearchController::class, 'showOrdinance'])->name('public.ordinance.show');
Route::get('/records/resolution/{resolution}', [PublicSearchController::class, 'showResolution'])->name('public.resolution.show');

// Guest Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

// Protected Adminisrtative Routes
Route::middleware('auth')->group(function() {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::redirect('/', '/admin/ordinances');

        Route::resource('ordinances', OrdinanceController::class);
        Route::resource('resolutions', ResolutionController::class);
    });
});
