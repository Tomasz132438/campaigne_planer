<?php

declare(strict_types=1);

namespace App\Http\Controllers\Campaign;

use App\Http\Controllers\BaseController;
use App\Models\Campaign;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ShowCampaignController extends BaseController
{
    use AuthorizesRequests;

    public function __invoke(Campaign $campaign): View
    {
        $this->authorize('view', $campaign);
        $campaign->load('configuration');

        return $campaign->isConfigured()
            ? view('campaigns.show', compact('campaign'))
            : view('campaigns.configuration', compact('campaign'));
    }
}