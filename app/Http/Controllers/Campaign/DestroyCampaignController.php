<?php

declare(strict_types=1);

namespace App\Http\Controllers\Campaign;

use App\Http\Controllers\BaseController;
use App\Models\Campaign;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DestroyCampaignController extends BaseController
{
    use AuthorizesRequests;
    public function __invoke(Campaign $campaign): RedirectResponse
    {
        $this->authorize('delete', $campaign);

        try {
            DB::transaction(function () use ($campaign) {
                $campaign->configuration()?->delete();
                $campaign->delete();
            });

            return $this->successRedirect('dashboard', 'Kampania została usunięta.');
        } catch (\Throwable $e) {
            return $this->handleException(
                $e,
                'Błąd podczas usuwania kampanii',
                ['campaign_id' => $campaign->id],
                'Nie udało się usunąć kampanii. Spróbuj ponownie.'
            );
        }
    }
}