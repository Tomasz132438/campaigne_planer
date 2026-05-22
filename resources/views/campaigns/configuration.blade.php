<x-app-layout>
    <x-slot:title>
        Konfiguracja: {{ $campaign->name }}
    </x-slot:title>

    <div class="flex min-h-screen bg-slate-950 text-slate-100">
        <main class="flex-1 p-8 overflow-y-auto">
            <div class="max-w-4xl mx-auto">
                
                {{-- Nagłówek kontekstowy --}}
                <div class="flex items-center justify-between mb-8 pb-6 border-b border-slate-800">
                    <div>
                        <div class="flex items-center space-x-3">
                            <h1 class="text-2xl font-bold tracking-tight text-white">{{ $campaign->name }}</h1>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-800 text-indigo-400 border border-indigo-500/20">
                                ID: #{{ $campaign->id }}
                            </span>
                        </div>
                        <p class="text-sm text-slate-400 mt-1">Skonfiguruj swoją kampanię</p>
                    </div>
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
                </div>

                {{-- Alert z błędami walidacji --}}
                @if ($errors->any())
                    <div class="p-4 mb-6 bg-rose-500/10 border border-rose-500/20 rounded-xl text-rose-400 text-sm">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Formularz konfiguracyjny --}}
                <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-xl">
                    <form action="{{ route('campaigns.configuration.store', $campaign) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('POST')

                        {{-- Input 1: Nazwa produktu --}}
                        <div>
                            <label for="product_name" class="block text-sm font-semibold text-slate-200 mb-2">Nazwa produktu</label>
                            <input type="text" name="product_name" id="product_name" 
                                   value="{{ old('product_name', $campaign->configuration?->product_name ?? '') }}" 
                                   class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-100 placeholder-slate-600 focus:outline-none focus:border-indigo-500 transition text-sm"
                                   placeholder="Podaj nazwę produktu którego ma dotyczyć kampania"
                                   required>
                        </div>

                        {{-- Input 2: Opis produktu --}}
                        <div>
                            <label for="product_description" class="block text-sm font-semibold text-slate-200 mb-2">Opis produktu</label>
                            <textarea name="product_description" id="product_description" 
                                      class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-100 placeholder-slate-600 focus:outline-none focus:border-indigo-500 transition text-sm"
                                      placeholder="Napisz opis produktu którego ma dotyczyć kampania" required>{{ old('product_description', $campaign->configuration?->product_description ?? '') }}</textarea>
                        </div>

                        {{-- Input 3: Grupa docelowa --}}
                        <div>
                            <label for="target_audience" class="block text-sm font-semibold text-slate-200 mb-2">Grupa docelowa</label>
                            <input type="text" name="target_audience" id="target_audience" 
                                   value="{{ old('target_audience', $campaign->configuration?->target_audience ?? '') }}" 
                                   class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-100 placeholder-slate-600 focus:outline-none focus:border-indigo-500 transition text-sm"
                                   placeholder="Opisz swoją grupę docelową, np. 'Młodzi profesjonaliści w wieku 25-35 lat zainteresowani technologią'"
                                   required>
                        </div>

                        {{-- Input 4: Cel kampanii --}}
                        <div>
                            <label for="campaign_goal" class="block text-sm font-semibold text-slate-200 mb-2">Cel kampanii</label>
                            <input type="text" name="campaign_goal" id="campaign_goal" 
                                   value="{{ old('campaign_goal', $campaign->configuration?->campaign_goal ?? '') }}" 
                                   class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-100 placeholder-slate-600 focus:outline-none focus:border-indigo-500 transition text-sm"
                                   placeholder="Podaj cel kampanii, np. 'zwiększenie świadomości marki'"
                                   required>
                        </div>

                        {{-- Input 5: Ton of voice --}}
                        <div>
                            <label for="tone_of_voice" class="block text-sm font-semibold text-slate-200 mb-2">Styl wypowiedzi (Tone of Voice)</label>
                            <select name="tone_of_voice" 
                                    required
                                    id="tone_of_voice" 
                                    class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-100 focus:outline-none focus:border-indigo-500 transition text-sm scheme-dark">
                                @foreach([
                                    'professional' => 'Profesjonalny i ekspercki (B2B, autorytet)',
                                    'friendly'     => 'Przyjacielski i bezpośredni (Luźny, bliski klientowi)',
                                    'energetic'    => 'Energetyczny i motywujący (Sport, wyzwania, pasja)',
                                    'humorous'     => 'Zabawny i dowcipny (Rozrywka, viral)',
                                    'empathetic'   => 'Empatyczny i wspierający (Zdrowie, psychologia, pomoc)',
                                    'persuasive'   => 'Perswazyjny i sprzedażowy (Zorientowany na natychmiastową konwersję)'
                                ] as $value => $label)
                                    <option value="{{ $value }}" @selected(old('tone_of_voice', $campaign->configuration?->tone_of_voice ?? 'friendly') === $value)>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Input 6: Czas trwania kampanii (Od - Do) -> Dane bezpośrednio z tabeli 'campaigns' --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="start_date" class="block text-sm font-semibold text-slate-200 mb-2">Data rozpoczęcia</label>
                                <input type="date" 
                                    required
                                    name="start_date" 
                                    id="start_date" 
                                    value="{{ old('start_date', $campaign->start_date ? $campaign->start_date->format('Y-m-d') : '') }}" 
                                    class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-100 focus:outline-none focus:border-indigo-500 transition text-sm scheme-dark">
                            </div>

                            <div>
                                <label for="end_date" class="block text-sm font-semibold text-slate-200 mb-2">Data zakończenia</label>
                                <input type="date" 
                                    required
                                    name="end_date" 
                                    id="end_date" 
                                    value="{{ old('end_date', $campaign->end_date ? $campaign->end_date->format('Y-m-d') : '') }}" 
                                    class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-100 focus:outline-none focus:border-indigo-500 transition text-sm scheme-dark">
                            </div>
                        </div>

                        {{-- Input 7: Budżet -> Dane bezpośrednio z tabeli 'campaigns' --}}
                        <div>
                            <label for="budget" class="block text-sm font-semibold text-slate-200 mb-2">Budżet na całość kampanii</label>
                            <input type="number" name="budget" id="budget" 
                                    step="0.01" min="1"
                                   value="{{ old('budget', $campaign->budget ?? '') }}" 
                                   class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-100 placeholder-slate-600 focus:outline-none focus:border-indigo-500 transition text-sm [appearance:textfield] &::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                                   placeholder="0.00 PLN"
                                   required>
                        </div>

                        {{-- Input 8: Obszar działania --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <div>
                                <label for="geo_details" class="block text-sm font-semibold text-slate-200 mb-2">Szczegóły lokalizacji (Opcjonalnie)</label>
                                <input type="text" 
                                    name="geo_details" 
                                    id="geo_details" 
                                    value="{{ old('geo_details', $campaign->configuration?->geo_details ?? '') }}" 
                                    class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-100 placeholder-slate-600 focus:outline-none focus:border-indigo-500 transition text-sm"
                                    placeholder="np. Poznań, Niemcy i Francja, Śląsk">
                            </div>
                        </div>

                        {{-- Input 9: Kanały dystrybucji --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-200 mb-3">Wybierz media / kanały kampanii</label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @foreach([
                                    'facebook' => 'Facebook Ads & Organic',
                                    'instagram' => 'Instagram (Posty & Reels)',
                                    'linkedin' => 'LinkedIn B2B',
                                    'tiktok' => 'TikTok Short Video',
                                    'newsletter' => 'E-mail Newsletter',
                                    'google_ads' => 'Google Search Ads'
                                ] as $value => $label)
                                    <label class="flex items-center space-x-3 p-3 bg-slate-950 border border-slate-800 rounded-xl cursor-pointer hover:border-indigo-500/50 transition">
                                        <input type="checkbox" 
                                            name="channels[]" 
                                            value="{{ $value }}"
                                            @checked(in_array($value, old('channels', $campaign->configuration?->channels ?? [])))
                                            class="w-4 h-4 rounded border-slate-800 bg-slate-900 text-indigo-600 focus:ring-indigo-500/30 focus:ring-offset-slate-950">
                                        <span class="text-sm text-slate-300 font-medium select-none">{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- Input 10: Struktura wyjściowa --}}
                        <div>
                            <label for="output_structure" class="block text-sm font-semibold text-slate-200 mb-2">Struktura wyjściowa</label>
                            <textarea name="output_structure" id="output_structure" 
                                   class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-100 placeholder-slate-600 focus:outline-none focus:border-indigo-500 transition text-sm"
                                   placeholder="Napisz czego oczekujesz w wyniku działania kampanii..."
                                   required>{{ old('output', $campaign->configuration?->output ?? '') }}</textarea>
                        </div>

                        {{-- Input 11: Główne CTA --}}
                        <div>
                            <label for="main_cta" class="block text-sm font-semibold text-slate-200 mb-2">Główne CTA</label>
                            <input type="text" name="main_cta" id="main_cta" 
                                   value="{{ old('main_cta', $campaign->configuration?->main_cta ?? '') }}" 
                                   class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-100 placeholder-slate-600 focus:outline-none focus:border-indigo-500 transition text-sm"
                                   placeholder="Wpisz główne CTA dla tego produktu."
                                   required>
                        </div>

                        {{-- Input 12: Wykluczenia --}}
                        <div>
                            <label for="exclusions" class="block text-sm font-semibold text-slate-200 mb-2">Wykluczenia / Słowa zakazane</label>
                            <input type="text" name="exclusions" id="exclusions" 
                                   value="{{ old('exclusions', $campaign->configuration?->exclusions ?? '') }}" 
                                   class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-100 placeholder-slate-600 focus:outline-none focus:border-indigo-500 transition text-sm"
                                   placeholder="Podaj słowa lub frazy, które mają być wykluczone."
                                   required>
                        </div>

                        {{-- Przyciski zapisu --}}
                        <div class="flex items-center justify-end space-x-4 pt-4 border-t border-slate-800">
                            <a href="{{ route('campaigns.show', $campaign) }}"
                               class="px-5 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-slate-200 transition">
                                Anuluj
                            </a>
                            <button type="submit"
                                    class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl text-sm font-semibold shadow-lg shadow-indigo-600/20 transition duration-150">
                                Zapisz konfigurację
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </main>
    </div>
</x-app-layout>