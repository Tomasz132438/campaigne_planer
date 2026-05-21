<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-200 leading-tight">
            {{ __('Edycja całościowa kampanii: :name', ['name' => $campaign->name]) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-900 border border-slate-800 overflow-hidden shadow-sm sm:rounded-xl p-6">
                
                <form action="{{ route('campaigns.update', $campaign) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <h3 class="text-lg font-medium text-indigo-400 border-b border-slate-800 pb-2">1. Główne informacje</h3>

                    {{-- Nazwa kampanii --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-300">Nazwa kampanii</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $campaign->name) }}" class="mt-1 block w-full rounded-lg border-slate-800 bg-slate-950 text-slate-200 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('name') border-red-500 @enderror" required>
                        @error('name') <p class="mt-2 text-sm text-red-400">{{ $message }}</p> @enderror
                    </div>

                    {{-- Status kampanii --}}
                    <div>
                        <label for="status" class="block text-sm font-medium text-slate-300">Status</label>
                        <select name="status" id="status" class="mt-1 block w-full rounded-lg border-slate-800 bg-slate-950 text-slate-200 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="draft" {{ old('status', $campaign->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="active" {{ old('status', $campaign->status) === 'active' ? 'selected' : '' }}>Aktywna</option>
                            <option value="completed" {{ old('status', $campaign->status) === 'completed' ? 'selected' : '' }}>Zakończona</option>
                        </select>
                    </div>

                    {{-- Opis kampanii --}}
                    <div>
                        <label for="description" class="block text-sm font-medium text-slate-300">Opis ogólny</label>
                        <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-lg border-slate-800 bg-slate-950 text-slate-200 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>{{ old('description', $campaign->description) }}</textarea>
                    </div>


                    <h3 class="text-lg font-medium text-indigo-400 border-b border-slate-800 pt-4 pb-2">2. Szczegóły konfiguracji</h3>

                    {{-- Nazwa Produktu --}}
                    <div>
                        <label for="product_name" class="block text-sm font-medium text-slate-300">Nazwa produktu</label>
                        <input type="text" name="product_name" id="product_name" value="{{ old('product_name', $campaign->configuration?->product_name) }}" class="mt-1 block w-full rounded-lg border-slate-800 bg-slate-950 text-slate-200 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('product_name') border-red-500 @enderror" required>
                        @error('product_name') <p class="mt-2 text-sm text-red-400">{{ $message }}</p> @enderror
                    </div>

                    {{-- Opis Produktu --}}
                    <div>
                        <label for="product_description" class="block text-sm font-medium text-slate-300">Opis produktu / specyfikacja</label>
                        <textarea name="product_description" id="product_description" rows="4" class="mt-1 block w-full rounded-lg border-slate-800 bg-slate-950 text-slate-200 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>{{ old('product_description', $campaign->configuration?->product_description) }}</textarea>
                    </div>

                    {{-- Grupa docelowa --}}
                    <div>
                        <label for="target_audience" class="block text-sm font-medium text-slate-300">Grupa docelowa</label>
                        <input type="text" name="target_audience" id="target_audience" value="{{ old('target_audience', $campaign->configuration?->target_audience) }}" class="mt-1 block w-full rounded-lg border-slate-800 bg-slate-950 text-slate-200 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    </div>

                    {{-- Cel kampanii --}}
                    <div>
                        <label_cel for="campaign_goal" class="block text-sm font-medium text-slate-300">Cel główny</label_cel>
                        <input type="text" name="campaign_goal" id="campaign_goal" value="{{ old('campaign_goal', $campaign->configuration?->campaign_goal) }}" class="mt-1 block w-full rounded-lg border-slate-800 bg-slate-950 text-slate-200 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    </div>

                    {{-- Przyciski --}}
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