<?php

declare(strict_types=1);

namespace App\Http\Controllers\Campaign;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;

class EditCampaignController extends Controller
{
    public function __invoke(Campaign $campaign): View
    {
        Gate::authorize('update', $campaign);

        // Eager loading relacji, żeby uniknąć problemu N+1 w widoku
        $campaign->load('configuration');

        return view('campaigns.edit', compact('campaign'));
    }
}