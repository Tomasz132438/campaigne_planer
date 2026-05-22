<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CampaignConfiguration extends Model
{
    protected $fillable = [
        'name',
        'description',
        'status',
        'campaign_id',
        'product_name',
        'product_description',
        'target_audience',
        'campaign_goal',
        'tone_of_voice',
        'main_cta',
        'geo_details',
        'channels',
        'exclusions',
        'budget',
        'start_date',
        'end_date',
        'output_structure', 
    ];

    protected $attributes = [
        'tone_of_voice' => 'Professional',
    ];

    protected function casts(): array
    {
        return [
            'channels' => 'array',
            'budget' => 'decimal:2',
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }

    /**
     * Relacja odwrotna do głównego modelu kampanii.
     */
    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }

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

    public function isStarted(): bool
    {
        return $this->start_date && Carbon::parse($this->start_date)->isPast();
    }
}