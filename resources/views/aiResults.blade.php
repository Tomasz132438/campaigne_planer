<x-app-layout>
    <div class="max-w-5xl mx-auto py-10">
        <h2 class="text-2xl font-bold text-slate-200 mb-6">Wyniki AI: {{ $campaign->name }}</h2>

        <div class="space-y-6">
            @forelse($campaign->contents as $content)
                <div class="p-6 bg-slate-900 border border-slate-800 rounded-2xl">
                    <div class="flex justify-between mb-4">
                        <span class="text-xs font-bold text-indigo-400 uppercase tracking-widest">
                            {{ str_replace('_', ' ', $content->type) }}
                        </span>
                    </div>
                    <h3 class="text-xl font-bold text-slate-100 mb-2">{{ $content->title }}</h3>
                    <div class="prose prose-invert prose-sm max-w-none text-slate-300">
                        {!! Illuminate\Support\Str::markdown($content->content) !!}
                    </div>
                </div>
            @empty
                <p class="text-slate-500">Brak treści do wyświetlenia.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>