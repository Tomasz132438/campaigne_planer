<?php

namespace App\Actions;

use App\Models\Campaign;
use App\Jobs\ProcessCampaignAiGeneration;

class CreateCampaignAction
{
    public function execute(array $data): Campaign
    {
        // Tworzymy kampanię ze statusem roboczym (draft)
        $campaign = Campaign::create([
            'name' => $data['name'],
            'target_audience' => $data['target_audience'],
            'channel' => $data['channel'],
            'brief' => $data['brief'],
            'status' => 'draft',
        ]);

        // Wrzucamy ciężkie zapytanie do AI na kolejkę
        ProcessCampaignAiGeneration::dispatch($campaign);

        return $campaign;
    }
}