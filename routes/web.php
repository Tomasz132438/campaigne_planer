<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    LandingPageController,
    ProfileController
};
use App\Http\Controllers\Campaign\{
    CreateCampaignController,
    DestroyCampaignController,
    EditCampaignController,
    ShowCampaignController,
    UpdateCampaignController,
    StoreCampaignController,
    ConfigurationController
};

Route::get('/', LandingPageController::class)->name('landing');

Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    // Profil użytkownika
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    // Kampanie - RESTful
    Route::prefix('campaigns')->name('campaigns.')->group(function () {
        Route::get('/create', CreateCampaignController::class)->name('create');
        Route::post('/', StoreCampaignController::class)->name('store');
        
        Route::get('/{campaign}', ShowCampaignController::class)->name('show');
        Route::get('/{campaign}/edit', EditCampaignController::class)->name('edit');
        Route::put('/{campaign}', UpdateCampaignController::class)->name('update');
        Route::delete('/{campaign}', DestroyCampaignController::class)->name('destroy');
    });

    // Zagnieżdżone trasy dla konfiguracji - jedna definicja wystarczy
    Route::resource('campaigns.configuration', ConfigurationController::class)
        ->only(['store', 'update']);
});

require __DIR__.'/auth.php';