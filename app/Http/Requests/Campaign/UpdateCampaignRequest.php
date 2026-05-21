<?php

declare(strict_types=1);

namespace App\Http\Requests\Campaign;

use App\Models\Campaign;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCampaignRequest extends FormRequest
{
    public function authorize(): bool
    {
        $campaign = $this->route('campaign');
        return $campaign instanceof Campaign && $this->user()->can('update', $campaign);
    }

    public function rules(): array
    {
        return [
            // Główne dane kampanii
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'status' => ['required', 'string', 'in:draft,active,completed'],

            // Dane szczegółowej konfiguracji
            'product_name' => ['required', 'string', 'max:255'],
            'product_description' => ['required', 'string'],
            'target_audience' => ['required', 'string', 'max:255'],
            'campaign_goal' => ['required', 'string', 'max:255'],
        ];
    }
}