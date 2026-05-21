@props(['disabled' => false])

<input 
    @disabled($disabled) 
    {{ $attributes->merge([
        'class' => 'w-full bg-slate-950/50 border-slate-700/80 text-slate-100 placeholder-slate-500 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition duration-150'
    ]) }}
>