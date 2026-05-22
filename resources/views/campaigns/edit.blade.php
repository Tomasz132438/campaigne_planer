<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-200 leading-tight">
            {{ __('Pełna Edycja Kampanii: :name', ['name' => $campaign->name]) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-900 border border-slate-800 overflow-hidden shadow-sm sm:rounded-xl p-6">
                
                <form action="{{ route('campaigns.update', $campaign) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    @if ($errors->any())
    <div class="p-4 mb-4 text-white bg-red-600 rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                    <!-- Sekcja 1: Dane Podstawowe -->
                    <h3 class="text-lg font-medium text-indigo-400 border-b border-slate-800 pb-2">1. Dane Podstawowe</h3>
                    
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <label for="name" class="block text-sm font-medium text-slate-300">Nazwa kampanii</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $campaign->name) }}" class="mt-1 block w-full rounded-lg border-slate-800 bg-slate-950 text-slate-200 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('name') border-red-500 @enderror" >
                            @error('name') <p class="mt-2 text-sm text-red-400">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-slate-300">Status</label>
                            <select name="status" id="status" class="mt-1 block w-full rounded-lg border-slate-800 bg-slate-950 text-slate-200 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="draft" {{ old('status', $campaign->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="active" {{ old('status', $campaign->status) === 'active' ? 'selected' : '' }}>Aktywna</option>
                                <option value="completed" {{ old('status', $campaign->status) === 'completed' ? 'selected' : '' }}>Zakończona</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-slate-300">Opis ogólny</label>
                        <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-lg border-slate-800 bg-slate-950 text-slate-200 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" d>{{ old('description', $campaign->description) }}</textarea>
                    </div>

                    <!-- Sekcja 2: Parametry Operacyjne -->
                    <h3 class="text-lg font-medium text-indigo-400 border-b border-slate-800 pt-4 pb-2">2. Szczegóły Konfiguracji</h3>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <label for="product_name" class="block text-sm font-medium text-slate-300">Nazwa produktu</label>
                            <input type="text" name="product_name" id="product_name" value="{{ old('product_name', $campaign->configuration?->product_name) }}" class="mt-1 block w-full rounded-lg border-slate-800 bg-slate-950 text-slate-200 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" >
                        </div>

                        <div>
                            <label for="budget" class="block text-sm font-medium text-slate-300">Budżet</label>
                            <input type="number" step="0.01" name="budget" id="budget" value="{{ old('budget', $campaign->configuration?->budget) }}"
                                   class="mt-1 block w-full rounded-lg border-slate-800 bg-slate-950 text-slate-200 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm [appearance:textfield] &::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" >
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <label for="target_audience" class="block text-sm font-medium text-slate-300">Grupa docelowa</label>
                            <input type="text" name="target_audience" id="target_audience" value="{{ old('target_audience', $campaign->configuration?->target_audience) }}" class="mt-1 block w-full rounded-lg border-slate-800 bg-slate-950 text-slate-200 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" >
                        </div>

                        <div>
                            <label for="geo_details" class="block text-sm font-medium text-slate-300">Obszar / Lokalizacja</label>
                            <input 
                                type="text" 
                                name="geo_details" 
                                id="geo_details" 
                                value="{{ old('geo_details', $campaign->configuration?->geo_details) }}" 
                                class="mt-1 block w-full rounded-lg border-slate-800 bg-slate-950 text-slate-200 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            >
                        </div>
                    </div>

                    <div>
                        <label for="product_description" class="block text-sm font-medium text-slate-300">Specyfikacja produktu</label>
                        <textarea name="product_description" id="product_description" rows="3" class="mt-1 block w-full rounded-lg border-slate-800 bg-slate-950 text-slate-200 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" >{{ old('product_description', $campaign->configuration?->product_description) }}</textarea>
                    </div>

                    <div>
                        <label for="campaign_goal" class="block text-sm font-medium text-slate-300">Cel główny kampanii</label>
                        <input type="text" name="campaign_goal" id="campaign_goal" value="{{ old('campaign_goal', $campaign->configuration?->campaign_goal) }}" class="mt-1 block w-full rounded-lg border-slate-800 bg-slate-950 text-slate-200 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" >
                    </div>

                    <!-- Sekcja 3: Harmonogram -->
                    <h3 class="text-lg font-medium text-indigo-400 border-b border-slate-800 pt-4 pb-2">3. Harmonogram trwania</h3>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-slate-300">
                                Data rozpoczęcia 
                                @if($campaign->configuration?->isStarted()) 
                                    <span class="text-amber-400 text-xs">(Zablokowana - kampania wystartowała)</span> 
                                @endif
                            </label>
                            <input 
                                type="date" 
                                name="start_date" 
                                id="start_date" 
                                value="{{ old('start_date', $campaign->configuration?->start_date?->format('Y-m-d')) }}"
                                class="mt-1 block w-full rounded-lg border-slate-800 bg-slate-950 text-slate-200 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('start_date') border-red-500 @enderror"
                                @disabled($campaign->configuration?->isStarted())
                            >
                        </div>

                        <div>
                            <label for="end_date" class="block text-sm font-medium text-slate-300">Data zakończenia</label>
                            <input 
                                type="date" 
                                name="end_date" 
                                id="end_date" 
                                value="{{ old('end_date', $campaign->configuration?->end_date?->format('Y-m-d')) }}" 
                                class="mt-1 block w-full rounded-lg border-slate-800 bg-slate-950 text-slate-200 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('end_date') border-red-500 @enderror"
                            >
                            @error('end_date') <p class="mt-2 text-sm text-red-400">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Przyciski akcji -->
                    <div class="flex items-center justify-end gap-x-4 pt-4 border-t border-slate-800">
                        <a href="{{ route('campaigns.show', $campaign) }}" class="text-sm font-semibold text-slate-400 hover:text-slate-200 transition">
                            Anuluj
                        </a>
                        <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 transition">
                            Zapisz wszystkie zmiany
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>