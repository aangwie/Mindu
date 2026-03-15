@props(['active', 'icon'])

@php
$classes = ($active ?? false)
            ? 'flex items-center space-x-3 px-4 py-3 bg-blue-50 dark:bg-blue-600/10 text-blue-600 dark:text-blue-400 rounded-xl font-bold transition-all duration-200 group'
            : 'flex items-center space-x-3 px-4 py-3 text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50 hover:text-slate-900 dark:hover:text-white rounded-xl font-medium transition-all duration-200 group';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <div class="shrink-0">
        @if($icon === 'dashboard')
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path></svg>
        @elseif($icon === 'test')
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        @elseif($icon === 'history')
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        @elseif($icon === 'user')
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
        @endif
    </div>
    <span x-show="!minimized" x-transition.opacity :class="minimized ? 'hidden' : ''" class="truncate">{{ $slot }}</span>
</a>
