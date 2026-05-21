<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $campaigns = $request->user()->campaigns()->latest()->paginate(5);

        $userCampaigns = $request->user()->campaigns();
        $stats = [
            'total' => $userCampaigns->count(),
            'active' => $userCampaigns->where('status', 'active')->count(),
            'drafts' => $userCampaigns->where('status', 'draft')->count(),
        ];

        return view('dashboard', compact('campaigns', 'stats'));
    }
}