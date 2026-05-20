<?php

namespace App\Http\Controllers\Campaign;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class CreateCampaignController extends Controller
{
    public function __invoke(): View
    {
        return view('campaigns.create');
    }
}