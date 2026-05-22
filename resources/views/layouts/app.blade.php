<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CampaignAI') }} - Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-slate-950 text-slate-100">
    <!-- Używamy h-screen i overflow-hidden, aby zablokować scrollowanie całego okna -->
    <div class="h-screen flex overflow-hidden">
        
        <!-- Sidebar: fixed wysokość 100%, brak flex na poziomie aside -->
        <aside class="w-64 bg-slate-900 border-r border-slate-800 flex flex-col shrink-0 h-full">
            <div class="flex flex-col h-full">
                <!-- Góra (Logo + Nawigacja) - nie scrolluje się -->
                <div class="flex-shrink-0">
                    <div class="h-20 flex items-center px-6 border-b border-slate-800">
                        <a href="{{ route('dashboard') }}" class="text-xl font-black tracking-wider bg-gradient-to-r from-indigo-400 to-cyan-400 bg-clip-text text-transparent">
                            CampaignAI
                        </a>
                    </div>
                    <nav class="p-4 space-y-1">
                        <!-- ... Twoje linki ... -->
                    </nav>
                </div>

                <!-- Środek (Lista kampanii) - TO SIĘ BĘDZIE SCROLLOWAĆ -->
                <div class="flex-grow overflow-y-auto custom-scrollbar">
                    <x-shared.sidebar-campaigns />
                </div>

                <!-- Dół (Logout) - nie scrolluje się -->
                <div class="p-4 border-t border-slate-800 flex-shrink-0">
                    <!-- ... Twoje menu użytkownika ... -->
                </div>
            </div>
        </aside>

        <!-- Główna treść - scrolluje się niezależnie -->
        <div class="flex-1 flex flex-col min-w-0 overflow-y-auto">
            <header class="h-20 bg-slate-900/50 backdrop-blur-md border-b border-slate-800 flex items-center px-8 shrink-0">
                {{ $header ?? '' }}
            </header>

            <main class="p-8">
                {{ $slot }}
            </main>
        </div>
        
    </div>
</body>
</html>