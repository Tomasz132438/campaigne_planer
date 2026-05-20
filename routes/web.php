<?php

use App\Http\Controllers\Campaign\CreateCampaignController;
use App\Http\Controllers\Campaign\StoreCampaignController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Ekran powitalny Laravela (wygenerowany przez Breeze)
Route::get('/', LandingPageController::class)->name('landing');

// Wszystkie trasy w tej grupie wymagają bycia zalogowanym
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Główny panel aplikacji po zalogowaniu
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    // Zarządzanie kampaniami AI
    Route::prefix('campaigns')->name('campaigns.')->group(function () {
        Route::get('/create', CreateCampaignController::class)->name('create');
        Route::post('/', StoreCampaignController::class)->name('store');
    });

    // Trasy profilu użytkownika (wygenerowane przez Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';