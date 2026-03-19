<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CalendrierController;
use App\Http\Controllers\TontineController;
use App\Http\Controllers\MembreController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'gestionnaire'])->group(function () {
    Route::get('/tontines', [TontineController::class, 'index'])->name('tontines.index');
    Route::get('/tontines/{tontine}', [TontineController::class, 'show'])->name('tontines.show');
    Route::get('/membres', [MembreController::class, 'index'])->name('membres.index');
    Route::get('/membres/{membre}', [MembreController::class, 'show'])->name('membres.show');
    Route::get('/calendrier', [CalendrierController::class, 'index'])->name('calendrier.index');
    Route::post('/calendrier', [CalendrierController::class, 'store'])->name('calendrier.store');
    Route::delete('/calendrier/{id}', [CalendrierController::class, 'destroy'])->name('calendrier.destroy');
    Route::get('/calendrier-ui', function() {
        return view('calendrier.index');
    })->name('calendrier.ui');
});

require __DIR__.'/auth.php';
require __DIR__.'/dashboard.php';
