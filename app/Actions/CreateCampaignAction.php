<?php

namespace App\Actions;

use App\Models\Campaign;
use App\Jobs\ProcessCampaignAiGeneration;

class CreateCampaignAction
{
    public function execute(array $data): Campaign
    {
        return Campaign::create([
            'user_id' => auth()->id(),
            'name' => $data['name'],
            'description' => $data['description'],
            'status' => 'draft',
        ]);
    }
}