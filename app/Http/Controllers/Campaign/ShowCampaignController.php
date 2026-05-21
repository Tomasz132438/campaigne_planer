<?php

declare(strict_types=1);

namespace App\Http\Controllers\Campaign;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ShowCampaignController extends Controller
{
    use AuthorizesRequests;

    public function __invoke(Campaign $campaign): View
    {
        $this->authorize('view', $campaign);

        $campaign->load('configuration');

        // Jeśli konfiguracja istnieje, ładujemy widok PODGLĄDU (show)
        if ($campaign->configuration !== null) {
            return view('campaigns.show', compact('campaign'));
        }

        // Jeśli jej nie ma, ładujemy widok FORMULARZA (configuration)
        return view('campaigns.configuration', compact('campaign'));
    }
}