@props(['color' => 'blue', 'title' => '', 'value' => '', 'sub' => ''])

@php
    $accentColorMap = [
        'blue' => 'bg-blue-500',
        'indigo' => 'bg-indigo-500',
        'emerald' => 'bg-emerald-500',
        'rose' => 'bg-rose-500',
        'amber' => 'bg-amber-500',
        'purple' => 'bg-purple-500'
    ];
    $bgColor = $accentColorMap[$color] ?? 'bg-blue-500';
@endphp

<div {{ $attributes->merge(['class' => "p-8 neu-card neu-card-hover relative overflow-hidden group pt-12"]) }}>
    <div class="absolute top-0 left-0 w-full h-4 {{ $bgColor }} border-b-[3px] border-slate-900 dark:border-white"></div>
    <p class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-4">{{ $title }}</p>
    <h3 class="text-3xl font-black text-slate-900 dark:text-white mb-2">{{ $value }}</h3>
    <p class="text-xs text-slate-700 dark:text-slate-400 font-black">{{ $sub }}</p>
</div>
