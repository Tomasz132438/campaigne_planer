<?php

namespace App\Services;

use App\Models\Campaign;
use Gemini\Laravel\Facades\Gemini;
use Gemini\Data\GenerationConfig; // Import klasy
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CampaignAiService
{
    public function generateContent(Campaign $campaign): void
    {
        $data = $this->getCampaignData($campaign);
        $prompt = $this->buildPrompt($data);

        // Poprawna inicjalizacja konfiguracji
        $config = new GenerationConfig(temperature: 0.3);

        $response = Gemini::generativeModel('gemini-2.5-flash')
            ->withGenerationConfig($config)
            ->generateContent($prompt);

        $jsonData = $this->parseJsonResponse($response->text());

        $this->persistContent($campaign, $jsonData);
    }

    private function getCampaignData(Campaign $campaign): array
    {
        return array_merge($campaign->toArray(), $campaign->configuration?->toArray() ?? []);
    }

    private function buildPrompt(array $data): string
    {
        $template = File::get(resource_path('prompts/GenerateContentPrompt.txt'));
        return str_replace('{user_input}', json_encode($data), $template);
    }

    private function parseJsonResponse(string $text): array
    {
        // Ekstrakcja JSONa przy użyciu wyrażenia regularnego
        if (preg_match('/\{.*\}/s', $text, $matches)) {
            $data = json_decode($matches[0], true);
            if (json_last_error() === JSON_ERROR_NONE && isset($data['posts'])) {
                return $data;
            }
        }

        Log::error('AI Response parsing failed', ['response' => $text]);
        throw new \Exception("AI nie zwróciło poprawnego formatu JSON.");
    }

    private function persistContent(Campaign $campaign, array $data): void
    {
        DB::transaction(function () use ($campaign, $data) {
            $campaign->contents()->delete();
            foreach ($data['posts'] as $index => $item) {
                $campaign->contents()->create([
                    'type'    => $item['type'] ?? 'post',
                    'title'   => $item['title'],
                    'content' => $item['content'],
                    'order'   => $index,
                ]);
            }
        });
    }
}