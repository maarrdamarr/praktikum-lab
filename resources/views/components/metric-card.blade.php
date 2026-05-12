@props(['color' => 'blue', 'title' => '', 'value' => '', 'sub' => ''])

<div {{ $attributes->merge(['class' => "p-8 rounded-3xl bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 shadow-sm relative overflow-hidden group transition-all hover:border-{$color}-500"]) }}>
    <div class="absolute top-0 left-0 w-1 h-full bg-{{ $color }}-500"></div>
    <p class="text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-4">{{ $title }}</p>
    <h3 class="text-3xl font-extrabold text-slate-900 dark:text-white mb-2">{{ $value }}</h3>
    <p class="text-xs text-slate-500 font-medium">{{ $sub }}</p>
</div>
