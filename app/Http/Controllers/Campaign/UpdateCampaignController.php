<?php

declare(strict_types=1);

namespace App\Http\Controllers\Campaign;

use App\Actions\Campaign\UpdateCampaignAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Campaign\UpdateCampaignRequest;
use App\Models\Campaign;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class UpdateCampaignController extends Controller
{
    public function __invoke(
        UpdateCampaignRequest $request,
        Campaign $campaign,
        UpdateCampaignAction $action
    ): RedirectResponse {
        try {
            $action->execute($campaign, $request->validated());

            return redirect()
                ->route('campaigns.show', $campaign)
                ->with('status_success', 'Kampania wraz z konfiguracją została zaktualizowana.');

        } catch (\Throwable $e) {
            Log::error('Błąd całościowej aktualizacji kampanii', [
                'campaign_id' => $campaign->id,
                'exception' => $e->getMessage()
            ]);

            return back()
                ->withInput()
                ->with('status_error', 'Wystąpił błąd podczas zapisu danych.');
        }
    }
}