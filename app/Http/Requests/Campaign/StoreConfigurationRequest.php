<?php

declare(strict_types=1);

namespace App\Http\Requests\Campaign;

use Illuminate\Foundation\Http\FormRequest;

class StoreConfigurationRequest extends FormRequest
{
    /**
     * Określa, czy użytkownik jest autoryzowany do wykonania tego żądania.
     */
    public function authorize(): bool
    {
        // Pobiera instancję modelu {campaign} powiązaną z bieżącą trasą
        $campaign = $this->route('campaign');

        // Sprawdza uprawnienia 'update' w CampaignPolicy dla zalogowanego użytkownika
        return $this->user()->can('update', $campaign);
    }

    /**
     * Zwraca reguły walidacji, które mają zastosowanie do żądania.
     *
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'product_name'        => ['required', 'string', 'max:255'],
            'campaign_goal'       => ['required', 'string', 'max:255'],
            'product_description' => ['required', 'string'],
            'target_audience'     => ['required', 'string'],
            'tone_of_voice'       => ['required', 'string', 'max:100'],
            'geo_scope'           => ['required', 'string', 'max:100'],
            'main_cta'            => ['required', 'string', 'max:255'],
            'start_date'          => ['nullable', 'date', 'after_or_equal:today'],
            'end_date'            => ['nullable', 'date', 'after_or_equal:start_date'],
            
            // Walidacja struktury tablicy (np. checkboxy lub wielokrotny wybór)
            'channels'            => ['required', 'array', 'min:1'],
            'channels.*'          => ['required', 'string', 'max:50'],
            
            'exclusions'          => ['nullable', 'string'],
            'output_structure'     => ['nullable', 'string'],
        ];
    }

    /**
     * Opcjonalne: Własne nazwy atrybutów dla komunikatów o błędach.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'product_name'        => 'nazwa produktu',
            'campaign_goal'       => 'cel kampanii',
            'product_description' => 'opis produktu',
            'target_audience'     => 'grupa docelowa',
            'tone_of_voice'       => 'styl komunikacji',
            'geo_scope'           => 'zasięg geograficzny',
            'main_cta'            => 'główne wezwanie do działania (CTA)',
            'start_date'          => 'data rozpoczęcia',
            'end_date'            => 'data zakończenia',
            'channels'            => 'kanały komunikacji',
            'exclusions'          => 'wykluczenia',
            'output_structure'     => 'struktura wyjściowa',
        ];
    }
}