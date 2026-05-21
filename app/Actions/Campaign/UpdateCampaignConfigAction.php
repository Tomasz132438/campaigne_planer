<?php

declare(strict_types=1);

namespace App\Actions\Campaign;

use App\Models\Campaign;
use Illuminate\Support\Facades\DB;

class UpdateCampaignAction
{
    /**
     * Aktualizuje kampanię oraz jej zagnieżdżoną konfigurację.
     *
     * @param Campaign $campaign
     * @param array<string, mixed> $data
     */
    public function execute(Campaign $campaign, array $data): void
    {
        DB::transaction(function () use ($campaign, $data) {
            // 1. Aktualizacja danych głównych
            $campaign->update([
                'name' => $data['name'],
                'description' => $data['description'],
                'status' => $data['status'],
            ]);

            // 2. Aktualizacja lub utworzenie relacji (idempotentność)
            $campaign->configuration()->updateOrCreate(
                ['campaign_id' => $campaign->id],
                [
                    'product_name' => $data['product_name'],
                    'product_description' => $data['product_description'],
                    'target_audience' => $data['target_audience'],
                    'campaign_goal' => $data['campaign_goal'],
                ]
            );
        });
    }
}