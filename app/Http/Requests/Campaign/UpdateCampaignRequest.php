<?php

declare(strict_types=1);

namespace App\Http\Requests\Campaign;

use App\Models\Campaign;
use Carbon\Carbon;
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
        $campaign = $this->route('campaign');
        $startDate = $campaign->configuration?->start_date;
        $isPastStart = $startDate && Carbon::parse($startDate)->isPast();

        // Używamy 'sometimes', co oznacza: waliduj pole tylko wtedy, gdy występuje w żądaniu i nie jest puste
        return [
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['sometimes', 'required', 'string'],
            'status' => ['sometimes', 'required', 'string', 'in:draft,active,completed'],
            
            'product_name' => ['sometimes', 'required', 'string', 'max:255'],
            'product_description' => ['sometimes', 'required', 'string'],
            'target_audience' => ['sometimes', 'required', 'string', 'max:255'],
            'campaign_goal' => ['sometimes', 'required', 'string', 'max:255'],
            'budget' => ['sometimes', 'required', 'numeric', 'min:0'],
            'channels' => ['sometimes', 'required', 'array'],
            'channels.*' => ['string', 'max:255'],
            'output_structure' => ['sometimes', 'required', 'string'],
            'geo_details' => ['sometimes', 'nullable', 'string', 'max:255'],
            
            'start_date' => $isPastStart ? ['nullable'] : ['sometimes', 'required', 'date', 'after_or_equal:today'],
            'end_date' => ['sometimes', 'required', 'date', 'after:start_date'],
        ];
    }

    /**
     * Nadpisujemy zwalidowane dane, odrzucając puste ciągi znaków i nulle.
     */
    public function validated($key = null, $default = null): array
    {
        $validated = parent::validated();

        // Odfiltrowuje puste stringi, null i tablice. Wartość 0 lub false zostaje (np. budżet 0 jest poprawny)
        return array_filter($validated, fn ($value) => $value !== null && $value !== '');
    }
}