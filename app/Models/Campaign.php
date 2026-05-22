<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\CampaignConfiguration;

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

    // App\Models\Campaign.php

    public function configuration(): HasOne
    {
        return $this->hasOne(CampaignConfiguration::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isConfigured(): bool
    {
        return $this->relationLoaded('configuration')
            ? $this->configuration !== null
            : $this->configuration()->exists();
    }

    public function contents() {
        return $this->hasMany(CampaignContent::class)->orderBy('order');
    }
}