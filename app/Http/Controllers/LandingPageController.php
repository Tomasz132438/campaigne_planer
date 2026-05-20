<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LandingPageController extends Controller
{
    /**
     * Obsługuje wyświetlanie strony głównej (Landing Page).
     */
    public function __invoke(Request $request): View|RedirectResponse
    {
        // Jeśli użytkownik ma już aktywną sesję, przekieruj go do aplikacji
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('welcome');
    }
}