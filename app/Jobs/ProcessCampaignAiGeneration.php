<?php

namespace App\Jobs;

use App\Models\Campaign;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessCampaignAiGeneration implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Campaign $campaign)
    {
        // Sanitize or validate campaign data here if needed
    }

    public function handle(): void
    {
        // Tutaj nastąpi integracja z API OpenAI/Anthropic za pomocą klienta HTTP Laravela
        // Na potrzeby struktury symulujemy proces:
        sleep(3); 

        $this->campaign->update([
            'generated_content' => "Wygenerowana treść kampanii dla kanału {$this->campaign->channel}...",
            'status' => 'active',
        ]);
    }
}