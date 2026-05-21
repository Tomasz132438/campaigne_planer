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
    <div class="min-h-screen flex">
        
        <aside class="w-64 bg-slate-900 border-r border-slate-800 flex flex-col justify-between hidden md:flex shrink-0">
            <div>
                <div class="h-20 flex items-center px-6 border-b border-slate-800">
                    <a href="{{ route('dashboard') }}" class="text-xl font-black tracking-wider bg-gradient-to-r from-indigo-400 to-cyan-400 bg-clip-text text-transparent">
                        CampaignAI
                    </a>
                </div>
                
                <nav class="p-4 space-y-1">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl bg-slate-800 text-indigo-400 font-medium transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"></path></svg>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('campaigns.create') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-slate-400 hover:bg-slate-800/50 hover:text-slate-200 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        <span>Nowa Kampania</span>
                    </a>

                    {{-- AUTOMATYCZNE GENEROWANIE LISTY KAMPANII PRZEZ KOMPONENT --}}
                    <x-shared.sidebar-campaigns />
                </nav>
            </div>

            <div class="p-4 border-t border-slate-800">
                <div class="flex items-center justify-between">
                    <div class="truncate mr-2">
                        <p class="text-sm font-semibold text-slate-300 truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-slate-500 truncate">{{ Auth::user()->email }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="shrink-0">
                        @csrf
                        <button type="submit" class="p-2 text-slate-500 hover:text-red-400 rounded-lg hover:bg-slate-800 transition" title="Wyloguj się">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <div class="flex-1 flex flex-col min-w-0">
            <header class="h-20 bg-slate-900/50 backdrop-blur-md border-b border-slate-800 flex items-center justify-between px-4 sm:px-6 lg:px-8 shrink-0">
                <div>
                    @if (isset($header))
                        {{ $header }}
                    @endif
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
                {{ $slot }}
            </main>
        </div>
        
    </div>
</body>
</html>