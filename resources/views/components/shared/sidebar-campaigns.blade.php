{{-- Alert Sukcesu --}}
@if (session('status_success'))
    <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center space-x-3 shadow-lg shadow-emerald-950/20" role="alert">
        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span class="text-sm font-medium">{{ session('status_success') }}</span>
    </div>
@endif

{{-- Alert Błędu --}}
@if (session('status_error'))
    <div class="mb-6 p-4 rounded-xl bg-rose-500/10 border border-rose-500/20 text-rose-400 flex items-center space-x-3 shadow-lg shadow-rose-950/20" role="alert">
        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
        </svg>
        <span class="text-sm font-medium">{{ session('status_error') }}</span>
    </div>
@endif

@if($campaigns->isNotEmpty())
    <div class="pt-4 mt-4 border-t border-slate-800/60">
        <p class="px-4 text-xxs font-semibold uppercase tracking-wider text-slate-500">Ostatnie Kampanie</p>
        <div class="mt-2 space-y-1 px-2">
            @foreach($campaigns as $campaign)
                <a href="{{ route('campaigns.show', $campaign) }}" class="flex items-center justify-between px-3 py-2 rounded-lg text-sm text-slate-400 hover:bg-slate-800/40 hover:text-slate-200 transition group">
                    <span class="truncate pr-2 font-medium">{{ $campaign->name }}</span>
                    
                    {{-- Subtelna kropka statusu wyliczana na podstawie flagi konfiguracji lub statusu przetwarzania --}}
                    @if(!$campaign->isConfigured())
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse" title="Wymaga konfiguracji"></span>
                    @elseif($campaign->status === 'active')
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 shrink-0" title="Gotowa"></span>
                    @elseif($campaign->status === 'failed')
                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500 shrink-0" title="Błąd"></span>
                    @else
                        <span class="w-1.5 h-1.5 rounded-full bg-slate-600 shrink-0" title="Nieaktywna"></span>
                    @endif
                </a>

            @endforeach
        </div>
    </div>
@endif