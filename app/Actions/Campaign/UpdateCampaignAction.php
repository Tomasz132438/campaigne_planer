<?php

declare(strict_types=1);

namespace App\Actions\Campaign;

use App\Models\Campaign;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UpdateCampaignAction
{
    /**
     * Całościowa aktualizacja kampanii i konfiguracji w jednym miejscu.
     * Zapisuje tylko zmienione i niepuste pola.
     *
     * @param array<string, mixed> $data Przefiltrowane dane z Form Request
     */
    public function execute(Campaign $campaign, array $data): void
    {
        if (empty($data)) {
            return;
        }

        DB::transaction(function () use ($campaign, $data) {
            
            // 1. Aktualizacja danych głównych kampanii (tylko jeśli zostały przesłane)
            $campaignFields = ['name', 'description', 'status'];
            $campaignData = array_intersect_key($data, array_flip($campaignFields));
            
            if (!empty($campaignData)) {
                $campaign->fill($campaignData);
                
                if ($campaign->isDirty()) {
                    $campaign->save();
                }
            }

            // 2. Przygotowanie danych szczegółowych konfiguracji
            $configFields = ['product_name', 'product_description', 'target_audience', 'campaign_goal', 'budget', 'area', 'ends_at'];
            
            // Warunek biznesowy: Jeśli data startu już minęła, nie pozwalamy jej nadpisać
            $currentStartsAt = $campaign->configuration?->starts_at;
            $isPastStart = $currentStartsAt && Carbon::parse($currentStartsAt)->isPast();
            
            if (!$isPastStart) {
                $configFields[] = 'starts_at';
            }

            $configData = array_intersect_key($data, array_flip($configFields));

            if (!empty($configData)) {
                // Pobiera relację lub tworzy świeżą instancję przypisaną do kampanii
                $configuration = $campaign->configuration ?? $campaign->configuration()->make();
                
                $configuration->fill($configData);
                
                if ($configuration->isDirty()) {
                    $configuration->save();
                }
            }
        });
    }
}