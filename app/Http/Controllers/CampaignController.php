<?php
namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Services\CampaignAiService;
use Illuminate\View\View;

class CampaignController extends Controller
{
    // Wyświetla szczegóły kampanii i stan konfiguracji
    public function show(Campaign $campaign): View
    {
        // Załaduj relację konfiguracji, jeśli jej nie ma
        $campaign->loadMissing('configuration');
        
        return view('campaigns.show', compact('campaign'));
    }

    // Wyświetla tylko wynik AI (osobny widok)
    public function showResults(Campaign $campaign)
    {
        // Ładujemy relację contents, żeby uniknąć problemu N+1
        $campaign->load('contents');
        
        return view('aiResults', compact('campaign'));
    }
}