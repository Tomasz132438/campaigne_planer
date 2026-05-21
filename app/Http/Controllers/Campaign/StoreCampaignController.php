<?php

declare(strict_types=1);

namespace App\Http\Controllers\Campaign;

use App\Http\Controllers\Controller;
use App\Http\Requests\Campaign\StoreCampaignRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class StoreCampaignController extends Controller
{
    public function __invoke(StoreCampaignRequest $request): RedirectResponse
    {
        try {
            // Tworzymy wyłącznie kampanię – dane konfiguracji powstaną w osobnym kroku kreatora
            $campaign = $request->user()->campaigns()->create($request->validated());

            return redirect()
                ->route('dashboard')
                ->with('status_success', 'Kampania została pomyślnie utworzona!');

        } catch (\Throwable $e) {
            Log::error('Błąd podczas tworzenia kampanii', [
                'user_id' => $request->user()?->id,
                'payload' => $request->validated(),
                'exception' => $e->getMessage(),
            ]);

            return back()
                ->withInput()
                ->with('status_error', 'Wystąpił błąd podczas zapisywania danych. Spróbuj ponownie.');
        }
    }
}