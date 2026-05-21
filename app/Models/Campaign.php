<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Campaign extends Model
{
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'status',
        'product_name',
        'product_description',
        'target_audience',
        'campaign_goal',
        'tone_of_voice',
        'start_date',
        'end_date',
        'budget',
        'geo_scope',
        'channels',
        'output_structure',
        'main_cta',
        'exclusions',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'generated_content' => 'array',
            'start_date' => 'date',
            'end_date' => 'date',
            'channels' => 'array', // Rekomendacja: jeśli przechowujesz wiele kanałów w jednej kolumnie
        ];
    }

    /**
     * Nowoczesny Akcesor i Mutator dla budżetu (konwersja PLN <-> Grosze)
     */
    protected function budget(): Attribute
    {
        return Attribute::make(
            get: static fn (?int $value): ?float => $value ? $value / 100 : null,
            set: static fn (float|int|string|null $value): ?int => $value ? (int) round((float) $value * 100) : null,
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function configuration(): HasOne
    {
        return $this->hasOne(CampaignConfiguration::class);
    }

    /**
     * Sprawdza, czy kampania posiada przypisaną konfigurację.
     */
    public function isConfigured(): bool
    {
        return $this->relationLoaded('configuration')
            ? $this->configuration !== null
            : $this->configuration()->exists();
    }
}