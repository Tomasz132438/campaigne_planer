<?php

namespace App\Http\Controllers\Campaign;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CampaignConfigurationController extends Controller
{
    use AuthorizesRequests;
    
    public function __invoke(Campaign $campaign): View
    {
        $this->authorize('view', $campaign);
        
        return view('campaigns.show', compact('campaign'));
    }
}