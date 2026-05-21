<?php

declare(strict_types=1);

namespace App\Http\Controllers\Campaign;

use App\Actions\Campaign\UpdateCampaignConfigAction;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Campaign\UpdateCampaignRequest;
use App\Models\Campaign;
use Illuminate\Http\RedirectResponse;

class UpdateCampaignController extends BaseController
{
    public function __invoke(
        UpdateCampaignRequest $request,
        Campaign $campaign,
        UpdateCampaignConfigAction $action
    ): RedirectResponse {
        try {
            $action->execute($campaign, $request->validated());

            return $this->successRedirect('campaigns.show', 'Kampania została zaktualizowana.');
        } catch (\Throwable $e) {
            return $this->handleException(
                $e,
                'Błąd podczas aktualizacji kampanii',
                ['campaign_id' => $campaign->id],
                'Wystąpił błąd podczas zapisu danych.'
            );
        }
    }
}