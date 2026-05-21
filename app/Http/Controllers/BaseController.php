<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

abstract class BaseController extends Controller
{
    protected function handleException(
        Throwable $e,
        string $logContext,
        array $logData = [],
        string $errorMessage = 'Wystąpił błąd. Spróbuj ponownie.'
    ): RedirectResponse {
        Log::error($logContext, array_merge($logData, ['exception' => $e->getMessage()]));

        return back()
            ->withInput()
            ->with('status_error', $errorMessage);
    }

    protected function successRedirect(string $route, string $message): RedirectResponse
    {
        return redirect()
            ->route($route)
            ->with('status_success', $message);
    }
}
