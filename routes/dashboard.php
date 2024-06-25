<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\SettingsController;
use Illuminate\Support\Facades\Route;

// Prefix dashboard is added in Route service provider
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('settings', [SettingsController::class, 'index'])->name('settings');
Route::post('settings/update', [SettingsController::class, 'update'])->name('settings.update');
