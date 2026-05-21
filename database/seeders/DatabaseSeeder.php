<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Pobieramy lub tworzymy użytkownika testowego (Hasło '123123123' jest już zahaszowane w bazie z Twojego dumpu)
        $user = User::firstOrCreate(
            ['email' => 'test@test.pl'],
            [
                'name' => 'Test',
                'password' => '$2y$12$NzwKAELwnNpZuwICHLA4FO8wBjJtjR0JJAdv93dduKKo7k/p1kSGO',
            ]
        );

        // 2. Tworzymy kampanię - przekazujemy tylko te pola, które fizycznie istnieją w tabeli `campaigns`
        $campaign = $user->campaigns()->firstOrCreate(
            ['name' => 'Przykładowa Kampania AI'],
            [
                'description' => 'To jest automatycznie wygenerowany opis przykładowej kampanii marketingowej.',
                'status' => 'active', // 'active', 'failed' lub 'draft' zgodnie z logiką Twojego widoku
            ]
        );

        // 3. Tworzymy powiązaną konfigurację, gdzie znajdują się szczegółowe pola oraz JSON `channels`
        $campaign->configuration()->firstOrCreate(
            ['product_name' => 'SaaS Analytics Tool'],
            [
                'product_description' => 'Nowoczesne narzędzie do analityki aplikacji napisanych w Laravelu.',
                'target_audience' => 'Deweloperzy, CTO, Product Ownerzy.',
                'campaign_goal' => 'Zwiększenie rejestracji kont trial',
                'tone_of_voice' => 'Professional',
                'main_cta' => 'Wypróbuj za darmo',
                'geo_scope' => 'Krajowy',
                'geo_details' => 'Polska',
                // Przekazujemy tablicę - rzutowanie (AsJson/array) w modelu CampaignConfiguration automatycznie przekształci ją w format JSON
                'channels' => ['Facebook', 'LinkedIn', 'Google Ads'], 
                'exclusions' => 'Konkurencja bezpośrednia',
                'start_date' => '2026-06-01',
                'end_date' => '2026-08-31',
                'budget' => 5000,
                'output_structure' => 'Standard Grid',
            ]
        );
    }
}