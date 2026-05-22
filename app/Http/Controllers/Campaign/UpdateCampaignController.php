<?php
namespace App\Http\Controllers\Campaign;

use App\Http\Controllers\Controller;
use App\Http\Requests\Campaign\UpdateCampaignRequest;
use App\Models\Campaign;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
                           
class UpdateCampaignController extends Controller
{
    public function __invoke(UpdateCampaignRequest $request, Campaign $campaign): RedirectResponse
    {
        

         // Debug: sprawdź, jakie dane są przekazywane do kontrolera

        DB::transaction(function () use ($campaign, $request) {
            
            $data = $request->validated();
            dump($data);

            $campaign->update($data);

            $config = $campaign->configuration()->firstOrNew(['campaign_id' => $campaign->id]);

            $config->fill(array_filter(
                [
                    'product_name'        => $data['product_name'],
                    'product_description' => $data['product_description'],
                    'target_audience'     => $data['target_audience'],
                    'campaign_goal'       => $data['campaign_goal'],
                    'budget'              => $data['budget'],
                    'geo_details'           => $data['geo_details'] ?? null,
                    'start_date'          => $data['start_date'] ?? $config->start_date ?? null,
                    'end_date'            => $data['end_date'],
                ], fn($v) => !is_null($v))
            );

            $config->save();

            // $filteredData = array_filter($campaign->configuration->toArray(), fn($value) => !is_null($value));

            // dump($campaign->configuration()->first()); // Sprawdź czy to w ogóle istnieje

            // 4. Zapisz bezpośrednio na modelu
            if (!$campaign->configuration->save()) {
                throw new \RuntimeException('Błąd zapisu konfiguracji do bazy danych.');
            }
        });

        return to_route('campaigns.show', $campaign)
            ->with('success', 'Kampania została zaktualizowana.');
    }   
}