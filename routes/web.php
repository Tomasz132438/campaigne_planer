<?php

use App\Http\Controllers\Campaign\CampaignConfigurationController;
use App\Http\Controllers\Campaign\CreateCampaignController;
use App\Http\Controllers\Campaign\ShowCampaignController;
use App\Http\Controllers\Campaign\StoreCampaignController;
use App\Http\Controllers\Campaign\StoreConfigurationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Campaign\DestroyCampaignController;
use App\Http\Controllers\Campaign\EditCampaignController;
use App\Http\Controllers\Campaign\UpdateCampaignController;

Route::get('/', LandingPageController::class)->name('landing');

Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::prefix('campaigns')->name('campaigns.')->group(function () {
        Route::get('/create', CreateCampaignController::class)->name('create');
        Route::post('/', StoreCampaignController::class)->name('store');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Konfiguracja kampanii (Zasoby zależne od {campaign})
    Route::get('/campaigns/{campaign}/configuration', CampaignConfigurationController::class)->name('campaigns.configuration');
    Route::post('/campaigns/{campaign}/configuration', StoreConfigurationController::class)->name('campaigns.configuration.store'); // Obsługa formularza (Zapis)

    Route::get('/campaigns/{campaign}', ShowCampaignController::class)->name('campaigns.show');



    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::prefix('campaigns')->name('campaigns.')->group(function () {
        Route::get('/create', CreateCampaignController::class)->name('create');
        Route::post('/', StoreCampaignController::class)->name('store');
        Route::get('/{campaign}', ShowCampaignController::class)->name('show');
        Route::get('/{campaign}/edit', EditCampaignController::class)->name('edit');
        Route::put('/{campaign}', UpdateCampaignController::class)->name('update');
        Route::delete('/{campaign}', DestroyCampaignController::class)->name('destroy');
    });
});

require __DIR__.'/auth.php';









Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::prefix('campaigns')->name('campaigns.')->group(function () {
        Route::get('/create', CreateCampaignController::class)->name('create');
        Route::post('/', StoreCampaignController::class)->name('store');
        Route::get('/{campaign}', ShowCampaignController::class)->name('show');
        Route::get('/{campaign}/edit', EditCampaignController::class)->name('edit');
        Route::put('/{campaign}', UpdateCampaignController::class)->name('update');
        Route::delete('/{campaign}', DestroyCampaignController::class)->name('destroy');
    });
});