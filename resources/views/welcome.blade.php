<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CampAIgn - Automatyzacja Marketingu przez AI</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-white font-sans antialiased selection:bg-indigo-500 selection:text-white">

    <header class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between border-b border-slate-800">
        <div class="flex items-center space-x-2">
            <span class="text-2xl font-black tracking-wider bg-gradient-to-r from-indigo-400 to-cyan-400 bg-clip-text text-transparent">
                CampAIgn
            </span>
        </div>
        
        <div class="flex items-center space-x-4">
            @if (Route::has('login'))
                <a href="{{ route('login') }}" class="text-sm font-medium text-slate-300 hover:text-white transition">
                    Zaloguj się
                </a>
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-lg hover:bg-indigo-500 shadow-lg shadow-indigo-600/20 transition duration-150">
                    Zarejestruj się za darmo
                </a>
            @endif
        </div>
    </header>

    <main class="relative isolate overflow-hidden">
        <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
            <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-20 sm:left-[calc(50%-30rem)] sm:w-[72.187rem]"></div>
        </div>

        <div class="mx-auto max-w-7xl px-4 pt-20 pb-24 sm:px-6 lg:px-8 text-center">
            <div class="mx-auto max-w-3xl">
                <span class="inline-flex items-center rounded-md bg-indigo-500/10 px-3 py-1 text-sm font-medium text-indigo-400 ring-1 ring-inset ring-indigo-500/20 mb-6">
                    Sztuczna Inteligencja nowej generacji w marketingu
                </span>
                
                <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-6xl bg-gradient-to-b from-white to-slate-400 bg-clip-text text-transparent">
                    Planuj, generuj i optymalizuj kampanie w kilka sekund
                </h1>
                
                <p class="mt-6 text-lg leading-8 text-slate-400">
                    Wprowadź krótki brief, wybierz kanał docelowy, a nasze AI przygotuje dla Ciebie kompletne struktury kampanii, angażujące opisy, nagłówki oraz harmonogram działań.
                </p>
                
                <div class="mt-10 flex items-center justify-center gap-x-6">
                    <a href="{{ route('register') }}" class="rounded-xl bg-indigo-600 px-6 py-3 text-base font-semibold text-white shadow-lg shadow-indigo-600/30 hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition">
                        Uruchom Generator AI →
                    </a>
                </div>
            </div>

            <div class="mx-auto mt-24 max-w-7xl px-6 sm:mt-32 lg:px-8">
                <div class="mx-auto max-w-2xl lg:max-w-none">
                    <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-3">
                        
                        <div class="flex flex-col bg-slate-800/50 p-8 rounded-2xl border border-slate-700/50 text-left">
                            <dt class="flex items-center gap-x-3 text-lg font-semibold leading-7 text-white">
                                <span class="text-2xl">⚡</span> Błyskawiczny Start
                            </dt>
                            <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-slate-400">
                                <p class="flex-auto">Omiń syndrom czystej kartki. Podaj grupę docelową, a algorytm zbuduje podwaliny pod strategię.</p>
                            </dd>
                        </div>

                        <div class="flex flex-col bg-slate-800/50 p-8 rounded-2xl border border-slate-700/50 text-left">
                            <dt class="flex items-center gap-x-3 text-lg font-semibold leading-7 text-white">
                                <span class="text-2xl">✍️</span> Copywriting AI
                            </dt>
                            <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-slate-400">
                                <p class="flex-auto">Dedykowane teksty dopasowane pod algorytmy Facebooka, LinkedIna oraz kampanii mailingowych w ułamku sekundy.</p>
                            </dd>
                        </div>

                        <div class="flex flex-col bg-slate-800/50 p-8 rounded-2xl border border-slate-700/50 text-left">
                            <dt class="flex items-center gap-x-3 text-lg font-semibold leading-7 text-white">
                                <span class="text-2xl">⚙️</span> Praca w Tle
                            </dt>
                            <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-slate-400">
                                <p class="flex-auto">Dzięki architekturze kolejek asynchronicznych zapytania do AI przetwarzają się w tle, nie blokując Twojego interfejsu.</p>
                            </dd>
                        </div>

                    </dl>
                </div>
            </div>
        </div>
    </main>

    <footer class="border-t border-slate-800 mt-12 bg-slate-950">
        <div class="mx-auto max-w-7xl px-6 py-12 md:flex md:items-center md:justify-between lg:px-8">
            <div class="mt-8 md:order-1 md:mt-0">
                <p class="text-center text-xs leading-5 text-slate-500">&copy; {{ date('Y') }} CampaignAI Planner. Wszystkie prawa zastrzeżone.</p>
            </div>
        </div>
    </footer>

</body>
</html>