<?php

namespace App\Http\Requests\Campaign;

use Illuminate\Foundation\Http\FormRequest;

class StoreCampaignRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // W przyszłości: auth()->check() lub autoryzacja przez Policy
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'target_audience' => ['required', 'string', 'max:500'],
            'channel' => ['required', 'string', 'in:Facebook,Instagram,LinkedIn,Email'],
            'brief' => ['required', 'string', 'min:10', 'max:2000'],
        ];
    }
}