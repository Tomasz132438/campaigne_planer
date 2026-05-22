<?php

namespace App\View\Components\Shared;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class SidebarCampaigns extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if (!Auth::check()) {
            return '';
        }
        elseif (Auth::user()->campaigns()->count() === 0) {
            return '';
        }
        $campaigns = Auth::user()->campaigns()->latest()->paginate(8);
        return view('components.shared.sidebar-campaigns', compact('campaigns'));
    }
}
