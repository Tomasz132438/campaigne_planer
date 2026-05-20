<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        // Sprawdzamy czy użytkownik jest zalogowany (jeśli jeszcze nie masz auth, użyj Campaign::...)
        $query = $request->user() ? $request->user()->campaigns() : Campaign::query();

        $campaigns = $query->latest()->paginate(5);

        $stats = [
            'total'  => $query->count(),
            'active' => (clone $query)->where('status', 'active')->count(),
            'drafts' => (clone $query)->where('status', 'draft')->count(),
        ];

        // POPRAWKA: 'stats' jako string w compact()
        return view('dashboard', compact('campaigns', 'stats'));
    }
}