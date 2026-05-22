<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    LandingPageController,
    ProfileController,
    CampaignController
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
use App\Http\Controllers\Ai\SendPromptController;

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

    Route::get('/ai', function () {
        return view('aiResults');
    });

    Route::post('/ai/send', [App\Http\Controllers\Ai\SendPromptController::class, 'sendPrompt'])->name('send.prompt');

    Route::post('campaigns/{campaign}/generate', \App\Http\Controllers\Ai\SendPromptController::class)->name('campaigns.generate');
    Route::get('campaigns/{campaign}/results', [CampaignController::class, 'showResults'])->name('campaigns.ai.results');

    Route::middleware(['auth'])->group(function () {
    // CRUD kampanii (zakładam, że masz już tu swój kontroler do tworzenia/usuwania)
    Route::resource('campaigns', CampaignController::class)->except(['index', 'show']);
    
    // Specyficzne widoki i akcje
    Route::get('campaigns/{campaign}', [CampaignController::class, 'show'])->name('campaigns.show');
    Route::get('campaigns/{campaign}/results', [CampaignController::class, 'showResults'])->name('campaigns.ai.results');
    
    // Akcja generowania (użyj innej trasy, żeby nie zaśmiecać głównego kontrolera)
    Route::post('campaigns/{campaign}/generate', \App\Http\Controllers\Ai\SendPromptController::class)
        ->name('campaigns.generate');
});
});

require __DIR__.'/auth.php';