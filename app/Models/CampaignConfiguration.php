<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CampaignConfiguration extends Model
{
    protected $fillable = [
        'campaign_id',
        'product_name',
        'product_description',
        'target_audience',
        'campaign_goal',
        'tone_of_voice',
        'main_cta',
        'geo_scope',
        'geo_details',
        'channels',
        'exclusions',
        'budget',
        'start_date',
        'end_date',
        'output_structure', 
    ];

    protected function casts(): array
    {
        return [
            'channels' => 'array',
            'budget' => 'decimal:2',
        ];
    }

    /**
     * Relacja odwrotna do głównego modelu kampanii.
     */
    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }
}