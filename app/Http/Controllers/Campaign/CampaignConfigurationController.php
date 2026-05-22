<?php

declare(strict_types=1);

namespace App\Http\Controllers\Campaign;

use App\Http\Controllers\BaseController;
use App\Models\Campaign;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CampaignConfigurationController extends BaseController
{
    use AuthorizesRequests;

    public function __invoke(Campaign $campaign): View
    {
        $this->authorize('view', $campaign);

        $campaign->load('configuration');

        $configuration = $campaign->configuration;


        return view('campaigns.configuration', compact('campaign', 'configuration'));
    }
}
