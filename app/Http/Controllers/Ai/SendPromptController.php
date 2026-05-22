<?php
namespace App\Http\Controllers\Ai;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Services\CampaignAiService;
use Illuminate\Http\RedirectResponse;

class SendPromptController extends Controller
{
    public function __invoke(Campaign $campaign, CampaignAiService $service): RedirectResponse
    {
        $service->generateContent($campaign);
        
        return to_route('campaigns.ai.results', $campaign);
    }
}