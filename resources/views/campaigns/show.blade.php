<x-app-layout>
    <x-slot:title>
        Podgląd kampanii: {{ $campaign->name }}
    </x-slot:title>
    {{-- Komunikat sukcesu --}}
    @if (session('success'))
        <div class="mb-6 rounded-lg bg-emerald-500/10 border border-emerald-500/20 p-4 text-emerald-400 text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    {{-- Komunikat błędu --}}
    @if (session('error'))
        <div class="mb-6 rounded-lg bg-red-500/10 border border-red-500/20 p-4 text-red-400 text-sm font-medium">
            {{ session('error') }}
        </div>
    @endif
    
    <div class="flex min-h-screen bg-slate-950 text-slate-100">
        <main class="flex-1 p-8 overflow-y-auto">
            <div class="max-w-4xl mx-auto">
                
                {{-- Nagłówek i Status --}}
                <div class="grid grid-cols-1 gap-6 md:grid-cols-3 md:items-start mb-8 pb-6 border-b border-slate-800">
                    <!-- Kolumna lewa: Tytuł i opis (Zajmuje 2 z 3 kolumn na desktopie) -->
                    <div class="md:col-span-2 space-y-3 min-w-0">
                        <div class="flex flex-wrap items-center gap-3">
                            <h1 class="text-2xl font-bold tracking-tight text-white break-words">{{ $campaign->name }}</h1>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 shrink-0">
                                Aktywna Konfiguracja
                            </span>
                        </div>

                        <div>
                            <p class="max-w-3xl text-base leading-relaxed text-slate-200 whitespace-pre-line break-words">{{ $campaign->description }}</p>
                        </div>

                        <p class="text-sm text-slate-400">Parametry operacyjne i strategia AI</p>
                    </div>

                    <!-- Kolumna prawa: Grupa przycisków akcji (Wyrównana do prawej na desktopie, responsywna) -->
                    <div class="flex flex-wrap items-center gap-3 md:justify-end shrink-0">
                        <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-slate-900 border border-slate-800 hover:bg-slate-800 rounded-xl text-sm font-medium text-slate-200 transition">
                            Powrót do pulpitu
                        </a>

                        @can('update', $campaign)
                            {{-- Przycisk Edycji Podstawowej --}}
                            <a 
                                href="{{ route('campaigns.edit', $campaign) }}" 
                                class="rounded-lg bg-indigo-600 px-3.5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 transition"
                            >
                                Edytuj kampanię
                            </a>

                            {{-- Bezpieczny Formularz Usuwania --}}
                            <form 
                                action="{{ route('campaigns.destroy', $campaign) }}" 
                                method="POST" 
                                onsubmit="return confirm('Czy na pewno chcesz bezpowrotnie usunąć tę kampanię wraz z jej konfiguracją?');"
                                class="inline"
                            >
                                @csrf
                                @method('DELETE')
                                <button 
                                    type="submit" 
                                    class="rounded-lg bg-red-600/10 px-3.5 py-2 text-sm font-semibold text-red-400 shadow-sm hover:bg-red-600 hover:text-white border border-red-500/20 transition"
                                >
                                    Usuń
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>

                {{-- Sekcja 1: Dane Finansowo-Czasowe (z tabeli campaigns) --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
                    <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 shadow-xl">
                        <span class="text-xs font-semibold text-slate-400 block uppercase tracking-wider">Budżet całkowity</span>
                        <span class="text-xl font-bold text-white mt-1 block">{{ number_format($campaign->configuration->budget, 2, ',', ' ') }} PLN</span>
                    </div>
                    <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 shadow-xl">
                        <span class="text-xs font-semibold text-slate-400 block uppercase tracking-wider">Data rozpoczęcia</span>
                        <span class="text-xl font-bold text-white mt-1 block">{{ \Carbon\Carbon::parse($campaign->configuration->start_date)->format('d.m.Y') }}</span>
                    </div>
                    <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 shadow-xl">
                        <span class="text-xs font-semibold text-slate-400 block uppercase tracking-wider">Data zakończenia</span>
                        <span class="text-xl font-bold text-white mt-1 block">{{ \Carbon\Carbon::parse($campaign->configuration->end_date)->format('d.m.Y') }}</span>
                    </div>
                </div>

                {{-- Sekcja 2: Szczegóły Konfiguracji AI (z tabeli campaign_configurations) --}}
                <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-xl space-y-6">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <span class="text-xs font-bold text-indigo-400 uppercase tracking-wider">Produkt / Usługa</span>
                            <p class="text-base text-white font-semibold mt-1 break-words">{{ $campaign->configuration->product_name }}</p>
                        </div>
                        <div>
                            <span class="text-xs font-bold text-indigo-400 uppercase tracking-wider">Cel główny</span>
                            <p class="text-base text-slate-200 mt-1 break-words">{{ $campaign->configuration->campaign_goal }}</p>
                        </div>
                    </div>

                    <div class="border-t border-slate-800/60 pt-4">
                        <span class="text-xs font-bold text-indigo-400 uppercase tracking-wider">Szczegółowy opis produktu</span>
                        <p class="text-sm text-slate-300 mt-1 whitespace-pre-line leading-relaxed break-words">{{ $campaign->configuration->product_description }}</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-t border-slate-800/60 pt-4">
                        <div>
                            <span class="text-xs font-bold text-indigo-400 uppercase tracking-wider">Grupa docelowa (Audience)</span>
                            <p class="text-sm text-slate-300 mt-1 break-words">{{ $campaign->configuration->target_audience }}</p>
                        </div>
                        <div>
                            <span class="text-xs font-bold text-indigo-400 uppercase tracking-wider">Styl komunikacji (Tone of Voice)</span>
                            <p class="text-sm text-slate-300 mt-1 font-medium capitalize">{{ $campaign->configuration->tone_of_voice }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-t border-slate-800/60 pt-4">
                        <div>
                            <span class="text-xs font-bold text-indigo-400 uppercase tracking-wider">Zasięg geograficzny</span>
                            <p class="text-sm text-slate-300 mt-1 break-words">
                                <!-- <span class="uppercase font-semibold text-xs bg-slate-950 px-2 py-1 rounded border border-slate-800 mr-2">
                                    {{ $campaign->configuration->geo_scope }}
                                </span> -->
                                {{ $campaign->configuration->geo_details ?? 'Brak dodatkowych szczegółów' }}
                            </p>
                        </div>
                        <div>
                            <span class="text-xs font-bold text-indigo-400 uppercase tracking-wider">Główne Wezwanie do Działania (CTA)</span>
                            <p class="text-sm text-emerald-400 font-semibold mt-1 break-words">{{ $campaign->configuration->main_cta }}</p>
                        </div>
                    </div>

                    {{-- Kanały dystrybucji przetworzone jako tagi --}}
                    <div class="border-t border-slate-800/60 pt-4">
                        <span class="text-xs font-bold text-indigo-400 uppercase tracking-wider block mb-2">Wybrane media i kanały reklamowe</span>
                        <div class="flex flex-wrap gap-2">
                            @if(is_array($campaign->configuration->channels))
                                @foreach($campaign->configuration->channels as $channel)
                                    <span class="px-3 py-1 bg-slate-950 border border-slate-800 rounded-xl text-xs font-medium text-indigo-300 uppercase tracking-wider">
                                        {{ str_replace('_', ' ', $channel) }}
                                    </span>
                                @endforeach
                            @else
                                <span class="text-sm text-slate-500">Nie wybrano kanałów.</span>
                            @endif
                        </div>
                    </div>

                    @if($campaign->configuration->exclusions)
                        <div class="border-t border-slate-800/60 pt-4">
                            <span class="text-xs font-bold text-rose-400 uppercase tracking-wider">Wykluczenia i frazy zakazane</span>
                            <p class="text-sm text-slate-400 mt-1 break-words">{{ $campaign->configuration->exclusions }}</p>
                        </div>
                    @endif

                    {{-- Sekcja 3: Wynik z AI --}}
                    <div class="border-t border-slate-800 pt-6 mt-6">
                        <span class="text-xs font-bold text-amber-400 uppercase tracking-wider block mb-2">Strategia marketingowa wygenerowana przez AI</span>
                        <div class="p-5 bg-slate-950 border border-slate-800/80 rounded-2xl text-sm text-slate-200 whitespace-pre-line leading-relaxed shadow-inner">
                            {{ $campaign->configuration->output ?? 'Strategia i makiety są w trakcie generowania przez LLM...' }}
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>
</x-app-layout>