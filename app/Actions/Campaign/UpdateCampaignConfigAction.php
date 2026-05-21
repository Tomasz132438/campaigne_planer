<?php

declare(strict_types=1);

namespace App\Actions\Campaign;

use App\Models\Campaign;
use Illuminate\Support\Facades\DB;

class UpdateCampaignAction
{
    public function execute(Campaign $campaign, array $data): void
    {
        DB::transaction(function () use ($campaign, $data) {
            $campaign->update($this->getMainCampaignData($data));
            $campaign->configuration()->updateOrCreate(
                ['campaign_id' => $campaign->id],
                $this->getConfigurationData($data)
            );
        });
    }

    private function getMainCampaignData(array $data): array
    {
        return [
            'name' => $data['name'],
            'description' => $data['description'],
            'status' => $data['status'] ?? 'draft',
        ];
    }

    private function getConfigurationData(array $data): array
    {
        return [
            'product_name' => $data['product_name'],
            'product_description' => $data['product_description'],
            'target_audience' => $data['target_audience'],
            'campaign_goal' => $data['campaign_goal'],
            'tone_of_voice' => $data['tone_of_voice'] ?? null,
            'geo_scope' => $data['geo_scope'] ?? null,
            'main_cta' => $data['main_cta'] ?? null,
            'channels' => $data['channels'] ?? [],
            'exclusions' => $data['exclusions'] ?? null,
            'output_structure' => $data['output_structure'] ?? null,
            'start_date' => $data['start_date'] ?? null,
            'end_date' => $data['end_date'] ?? null,
        ];
    }
}