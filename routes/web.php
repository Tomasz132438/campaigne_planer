<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Campaign\CreateCampaignController;
use App\Http\Controllers\Campaign\StoreCampaignController;
use App\Http\Controllers\DashboardController;

Route::get('/', DashboardController::class)->name('dashboard');

Route::prefix('campaigns')->name('campaigns.')->group(function () {
    Route::get('/create', CreateCampaignController::class)->name('create');
    Route::post('/', StoreCampaignController::class)->name('store');
});


