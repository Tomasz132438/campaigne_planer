<?php

declare(strict_types=1);

namespace App\Http\Controllers\Campaign;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class DestroyCampaignController extends Controller
{
    /**
     * Wykonuje akcję usunięcia kampanii.
     */
    public function __invoke(Campaign $campaign): RedirectResponse
    {
        // Bezpieczeństwo: Autoryzacja przez fasadę Gate (wywołuje CampaignPolicy@delete)
        Gate::authorize('delete', $campaign);

        try {
            DB::transaction(function () use ($campaign) {
                $campaign->configuration()?->delete();
                $campaign->delete();
            });

            return redirect()
                ->route('dashboard')
                ->with('status_success', 'Kampania została trwale usunięta.');

        } catch (\Throwable $e) {
            Log::error('Błąd podczas usuwania kampanii', [
                'campaign_id' => $campaign->id,
                'exception' => $e->getMessage()
            ]);

            return back()->with('status_error', 'Nie udało się usunąć kampanii. Spróbuj ponownie.');
        }
    }
}