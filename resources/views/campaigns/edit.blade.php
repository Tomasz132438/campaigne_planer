<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-200 leading-tight">
            {{ __('Edycja Kampanii: :name', ['name' => $campaign->name]) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-900 border border-slate-800 overflow-hidden shadow-sm sm:rounded-xl p-6">
                
                {{-- Globalne komunikaty o błędach / sukcesie --}}
                @if (session('status_error'))
                    <div class="mb-6 p-4 bg-red-500/10 border border-red-500/50 rounded-xl text-sm text-red-400">
                        {{ session('status_error') }}
                    </div>
                @endif

                <form action="{{ route('campaigns.update', $campaign) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- Nazwa kampanii --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-300">
                            Nazwa kampanii
                        </label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            value="{{ old('name', $campaign->name) }}"
                            class="mt-1 block w-full rounded-lg border-slate-800 bg-slate-950 text-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('name') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                            required
                            maxlength="255"
                        >
                        @error('name')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Opis kampanii --}}
                    <div>
                        <label for="description" class="block text-sm font-medium text-slate-300">
                            Opis kampanii
                        </label>
                        <textarea 
                            name="description" 
                            id="description" 
                            rows="5"
                            class="mt-1 block w-full rounded-lg border-slate-800 bg-slate-950 text-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm whitespace-pre-line break-words @error('description') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                            required
                        >{{ old('description', $campaign->description) }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Status kampanii --}}
                    <div>
                        <label for="status" class="block text-sm font-medium text-slate-300">
                            Status
                        </label>
                        <select 
                            name="status" 
                            id="status"
                            class="mt-1 block w-full rounded-lg border-slate-800 bg-slate-950 text-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('status') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                        >
                            <option value="draft" {{ old('status', $campaign->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="active" {{ old('status', $campaign->status) === 'active' ? 'selected' : '' }}>Aktywna</option>
                            <option value="completed" {{ old('status', $campaign->status) === 'completed' ? 'selected' : '' }}>Zakończona</option>
                        </select>
                        @error('status')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Przyciski akcji --}}
                    <div class="flex items-center justify-end gap-x-4 pt-4 border-t border-slate-800">
                        <a 
                            href="{{ route('dashboard') }}" 
                            class="text-sm font-semibold leading-6 text-slate-400 hover:text-slate-200 transition"
                        >
                            Anuluj
                        </a>
                        <button 
                            type="submit" 
                            class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition"
                        >
                            Zapisz zmiany
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>