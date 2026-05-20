@props(['route', 'icon', 'label', 'collapsed'])

@php
    $isActive = Route::currentRouteName() == $route;
@endphp

<a href="{{ route($route) }}" 
   class="flex items-center gap-3 p-3 transition-all duration-200 {{ $isActive ? 'sidebar-active' : 'border-[3px] border-transparent hover:border-slate-900 dark:hover:border-white hover:shadow-[3px_3px_0px_#000] dark:hover:shadow-[3px_3px_0px_#fff] hover:translate-x-[-2px] hover:translate-y-[-2px] text-slate-800 dark:text-slate-350 font-black rounded-xl bg-white dark:bg-slate-900' }} group"
   title="{{ $label }}">
    <svg class="w-5 h-5 shrink-0 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"></path>
    </svg>
    <span x-show="!sidebarCollapsed" 
          x-transition:enter="transition ease-out duration-300"
          x-transition:enter-start="opacity-0 -translate-x-4"
          x-transition:enter-end="opacity-100 translate-x-0"
          class="font-black text-sm truncate">{{ $label }}</span>
</a>
