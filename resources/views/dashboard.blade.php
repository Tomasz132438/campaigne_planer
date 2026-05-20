<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <h1 class="text-xl font-bold text-white tracking-tight">Centrum Dowodzenia Kampaniami</h1>
            <a href="{{ route('campaigns.create') }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-xl hover:bg-indigo-500 shadow-lg shadow-indigo-600/20 transition duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Nowa Kampania AI
            </a>
        </div>
    </x-slot>

    <div class="space-y-8">
        
        @if (session('status'))
            <div class="p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-xl flex items-center space-x-3" role="alert">
                <svg class="w-5 h-5 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <p class="text-sm font-medium text-emerald-400">{{ session('status') }}</p>
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 relative overflow-hidden group">
                <div class="absolute right-0 top-0 p-6 opacity-5 group-hover:opacity-10 transition">
                    <svg class="w-24 h-24 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Wszystkie projekty</p>
                <p class="mt-2 text-4xl font-black text-white font-mono tracking-tight">{{ $stats['total'] }}</p>
                <div class="mt-4 flex items-center text-xs text-slate-400">
                    <span class="text-indigo-400 font-medium mr-1">Suma</span> wprowadzonych briefów
                </div>
            </div>

            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 relative overflow-hidden group">
                <div class="absolute right-0 top-0 p-6 opacity-5 group-hover:opacity-10 transition">
                    <svg class="w-24 h-24 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Wygenerowane przez AI</p>
                <p class="mt-2 text-4xl font-black text-emerald-400 font-mono tracking-tight">{{ $stats['active'] }}</p>
                <div class="mt-4 flex items-center text-xs text-slate-400">
                    <span class="text-emerald-400 font-medium mr-1">Gotowe</span> do publikacji i wdrożenia
                </div>
            </div>

            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 relative overflow-hidden group sm:col-span-2 lg:col-span-1">
                <div class="absolute right-0 top-0 p-6 opacity-5 group-hover:opacity-10 transition">
                    <svg class="w-24 h-24 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 1121.253 8H18"></path></svg>
                </div>
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">W kolejce przetwarzania</p>
                <p class="mt-2 text-4xl font-black text-amber-400 font-mono tracking-tight">{{ $stats['drafts'] }}</p>
                <div class="mt-4 flex items-center text-xs text-slate-400">
                    <span class="text-amber-400 font-medium mr-1">Kolejka tła</span> analizuje i buduje dane
                </div>
            </div>

        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden shadow-xl">
            <div class="p-6 border-b border-slate-800">
                <h3 class="text-base font-bold text-white">Historia i statusy generowania</h3>
            </div>

            @if($campaigns->isEmpty())
                <div class="text-center py-16 px-4">
                    <div class="inline-flex items-center justify-center w-14 h-14 bg-slate-800 rounded-2xl text-slate-600 mb-4">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                    <h4 class="text-sm font-semibold text-slate-200">Brak zarejestrowanych kampanii</h4>
                    <p class="mt-1 text-xs text-slate-500 max-w-sm mx-auto">Twoje konto jest czyste. Kliknij przycisk powyżej, aby zasilić algorytmy AI pierwszym briefem marketingowym.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-950/40 text-slate-400 text-xs font-semibold uppercase border-b border-slate-800">
                                <th class="px-6 py-4">Nazwa kampanii</th>
                                <th class="px-6 py-4">Kanał docelowy</th>
                                <th class="px-6 py-4">Status operacji</th>
                                <th class="px-6 py-4 text-right">Data utworzenia</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/60 text-sm">
                            @foreach($campaigns as $campaign)
                                <tr class="hover:bg-slate-800/20 transition">
                                    <td class="px-6 py-4 font-semibold text-slate-200">
                                        {{ $campaign->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-slate-800 text-slate-300 border border-slate-700/50">
                                            {{ $campaign->channel }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($campaign->status === 'active')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                                <span class="w-1.5 h-1.5 mr-1.5 rounded-full bg-emerald-400"></span>
                                                Gotowa (AI)
                                            </span>
                                        @elseif($campaign->status === 'failed')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-rose-500/10 text-rose-400 border border-rose-500/20">
                                                <span class="w-1.5 h-1.5 mr-1.5 rounded-full bg-rose-400"></span>
                                                Błąd API
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-500/10 text-amber-400 border border-amber-500/20 animate-pulse">
                                                <span class="w-1.5 h-1.5 mr-1.5 rounded-full bg-amber-400"></span>
                                                Generowanie...
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right text-slate-400 font-mono text-xs">
                                        {{ $campaign->created_at->format('Y-m-d H:i') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($campaigns->hasPages())
                    <div class="p-6 border-t border-slate-800 bg-slate-950/20">
                        {{ $campaigns->links() }}
                    </div>
                @endif
            @endif
        </div>
        
    </div>
</x-app-layout>