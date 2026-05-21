<?php

declare(strict_types=1);

namespace App\Http\Controllers\Campaign;

use App\Http\Controllers\Controller;
use App\Http\Requests\Campaign\StoreConfigurationRequest;
use App\Models\Campaign;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class StoreConfigurationController extends Controller
{
    public function __invoke(StoreConfigurationRequest $request, Campaign $campaign): RedirectResponse
    {

        try {
            // 2. Bezpieczny zapis relacji
            $campaign->configuration()->updateOrCreate(
                ['campaign_id' => $campaign->id],
                $request->validated()
            );

            return redirect()
                ->route('dashboard')
                ->with('status_success', 'Konfiguracja kampanii została pomyślnie zapisana!');

        } catch (\Throwable $e) {
            Log::error('Błąd zapisu konfiguracji kampanii', [
                'campaign_id' => $campaign->id,
                'exception' => $e->getMessage(),
            ]);

            return back()
                ->withInput()
                ->with('status_error', 'Wystąpił błąd podczas zapisywania danych. Spróbuj ponownie.');
        }
    }
}