@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-slate-200 bg-white/50 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition-all duration-200 placeholder:text-slate-400 text-slate-700']) !!}>
