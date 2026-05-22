<?php

namespace App\Http\Controllers\Campaign;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Http\Requests\Campaign\UpdateCampaignRequest; // Użyj tego samego requesta co do update
use Illuminate\Http\RedirectResponse;

class ConfigurationController extends Controller
{
    public function store(UpdateCampaignRequest $request, Campaign $campaign): RedirectResponse
    {
        // dd($request->all());

        $data = $request->validated();

        $data['tone_of_voice'] = $data['tone_of_voice'] ?? 'Professional';
        $data['main_cta'] = $data['main_cta'] ?? 'Kliknij tutaj';
        // $data['channels'] = $data['channels'] ?? array();
        $data['output_structure'] = $data['output_structure'] ?? 'Standard';

        $data['output_structure'] = $request->input('output_structure', $data['output_structure'] ?? 'Standard');

        $campaign->configuration()->create($data);

        return to_route('campaigns.show', $campaign)->with('success', 'Konfiguracja utworzona.');
    }

    public function update(UpdateCampaignRequest $request, Campaign $campaign): RedirectResponse
    {
        // Logika aktualizacji konfiguracji
        $campaign->configuration()->updateOrCreate(
            ['campaign_id' => $campaign->id],
            $request->validated()
        );

        return to_route('campaigns.show', $campaign)->with('success', 'Konfiguracja zaktualizowana.');
    }
}