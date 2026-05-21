<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Kreator Nowej Kampanii AI') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-black overflow-hidden shadow-sm sm:rounded-lg border border-slate-700 p-6">


            <!-- BŁĘDY WALIDACJI -->
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-500/10 border border-red-500/50 rounded-xl text-sm text-red-400">
                        <p class="font-medium">Formularz zawiera błędy:</p>
                        <ul class="mt-2 list-disc list-inside opacity-90">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('campaigns.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-300">Nazwa kampanii</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 block w-full rounded-md border-slate-700 bg-slate-950/50 text-slate-300 placeholder:text-slate-500 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Nazwij swoją kampanię...">
                        @error('name') <p class="mt-1 text-sm text-red-600">{{ 'Musisz nazwać swoją kampanie' }}</p> @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-slate-300">Opis kampanii</label>
                        <textarea name="description" id="description" rows="4" placeholder="Opisz kampanię..." class="mt-1 block w-full reounded-md border-slate-700 bg-slate-950/50 text-slate-300 placeholder:text-slate-500 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('description') }}</textarea>
                        @error('description') <p class="mt-1 text-sm text-red-600">{{ 'Opisz krótko swoją kampanię' }}</p> @enderror
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 border border-slate-600 rounded-md text-sm font-medium text-slate-300 bg-slate-800 hover:bg-slate-600">Anuluj</a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 shadow-sm">
                            Stwórz kampanie
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>