<?php

namespace App\Http\Controllers\Campaign;

use App\Actions\CreateCampaignAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Campaign\StoreCampaignRequest;
use Illuminate\Http\RedirectResponse;

class StoreCampaignController extends Controller
{
    public function __invoke(StoreCampaignRequest $request, CreateCampaignAction $action): RedirectResponse
    {
        $action->execute($request->validated());

        return redirect()
            ->route('dashboard')
            ->with('status', 'Kampania została utworzona. AI generuje treści w tle!');
    }
}