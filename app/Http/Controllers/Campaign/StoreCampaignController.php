<?php

declare(strict_types=1);

namespace App\Http\Controllers\Campaign;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Campaign\StoreCampaignRequest;
use Illuminate\Http\RedirectResponse;

class StoreCampaignController extends BaseController
{
    public function __invoke(StoreCampaignRequest $request): RedirectResponse
    {
        try {
            $request->user()->campaigns()->create($request->validated());

            return $this->successRedirect('dashboard', 'Kampania została pomyślnie utworzona!');
        } catch (\Throwable $e) {
            return $this->handleException(
                $e,
                'Błąd podczas tworzenia kampanii',
                ['user_id' => $request->user()->id],
                'Wystąpił błąd podczas zapisywania danych. Spróbuj ponownie.'
            );
        }
    }
}