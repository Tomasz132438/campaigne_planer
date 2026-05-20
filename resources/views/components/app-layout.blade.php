<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Marketing AI') }}</title>

    <!-- Tailwind CSS z CDN na potrzeby szybkiego startu (w produkcji użyj Vite) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen">
        
        <!-- Prosta Nawigacja -->
        <nav class="bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="shrink-0 flex items-center font-bold text-indigo-600">
                            CampaignAI Planner
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Nagłówek Strony (Header Slot) -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Główna Treść Strony (Main Slot) -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>
</html>