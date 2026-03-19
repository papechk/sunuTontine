<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardSettingsController;

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard/settings', [DashboardSettingsController::class, 'edit'])->name('dashboard.settings.edit');
    Route::post('/dashboard/settings', [DashboardSettingsController::class, 'update'])->name('dashboard.settings.update');
});
