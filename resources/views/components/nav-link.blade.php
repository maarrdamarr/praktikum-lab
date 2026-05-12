@props(['route', 'icon', 'label', 'collapsed'])

@php
    $isActive = Route::currentRouteName() == $route;
@endphp

<a href="{{ route($route) }}" 
   class="flex items-center gap-3 p-3 rounded-xl transition-all duration-300 {{ $isActive ? 'sidebar-active bg-blue-50 dark:bg-blue-900/20 text-blue-600' : 'hover:bg-gray-50 dark:hover:bg-slate-800 text-slate-500 dark:text-slate-400' }} group"
   title="{{ $label }}">
    <svg class="w-5 h-5 shrink-0 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"></path>
    </svg>
    <span x-show="!sidebarCollapsed" 
          x-transition:enter="transition ease-out duration-300"
          x-transition:enter-start="opacity-0 -translate-x-4"
          x-transition:enter-end="opacity-100 translate-x-0"
          class="font-bold text-sm truncate">{{ $label }}</span>
</a>
