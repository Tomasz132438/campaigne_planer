<?php

declare(strict_types=1);

namespace App\Http\Controllers\Campaign;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Campaign\StoreConfigurationRequest;
use App\Models\Campaign;
use Illuminate\Http\RedirectResponse;

class StoreConfigurationController extends BaseController
{
    public function __invoke(StoreConfigurationRequest $request, Campaign $campaign): RedirectResponse
    {
        try {
            $campaign->configuration()->updateOrCreate(
                ['campaign_id' => $campaign->id],
                $request->validated()
            );

            return $this->successRedirect('dashboard', 'Konfiguracja kampanii została zapisana!');
        } catch (\Throwable $e) {
            return $this->handleException(
                $e,
                'Błąd zapisu konfiguracji kampanii',
                ['campaign_id' => $campaign->id],
                'Wystąpił błąd podczas zapisywania danych. Spróbuj ponownie.'
            );
        }
    }
}