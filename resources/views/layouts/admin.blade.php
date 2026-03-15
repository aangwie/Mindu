<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin - {{ config('app.name', 'Mindu') }}</title>

    @if($favicon = \App\Models\Setting::get('site_favicon'))
        <link rel="icon" type="image/x-icon" href="{{ $favicon }}">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        // Initial theme check
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body x-data="{ 
    darkMode: localStorage.getItem('theme') || 'system',
    sidebarOpen: false, 
    sidebarMinimized: localStorage.getItem('sidebarMinimized') === 'true',
    init() {
        this.applyTheme();
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
            if (this.darkMode === 'system') this.applyTheme();
        });
        this.$watch('sidebarMinimized', value => localStorage.setItem('sidebarMinimized', value));
    },
    applyTheme() {
        if (this.darkMode === 'dark' || (this.darkMode === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
        localStorage.setItem('theme', this.darkMode);
    }
}" class="bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-slate-100 antialiased min-h-screen flex flex-col md:flex-row transition-colors duration-300">
    <!-- Mobile Sidebar Backdrop -->
    <div x-show="sidebarOpen" 
         x-transition:enter="transition ease-in-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in-out duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="sidebarOpen = false"
         class="fixed inset-0 bg-slate-900/50 z-40 md:hidden" 
         style="display: none;"></div>

    <!-- Sidebar -->
    <aside :class="{
                'translate-x-0': sidebarOpen,
                '-translate-x-full': !sidebarOpen,
                'md:w-64': !sidebarMinimized,
                'md:w-20': sidebarMinimized
           }"
           class="fixed inset-y-0 left-0 z-50 bg-white dark:bg-slate-800 border-r border-slate-200 dark:border-slate-700 transform transition-all duration-300 ease-in-out md:sticky md:top-0 md:translate-x-0 md:z-0 flex flex-col h-screen shrink-0 overflow-x-hidden">
        <div :class="sidebarMinimized ? 'p-4 justify-center' : 'p-6 justify-between'" class="flex items-center">
            <a href="/admin" class="flex items-center overflow-hidden" x-show="!sidebarMinimized" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent truncate">
                    @if($logo = \App\Models\Setting::get('site_logo'))
                        <img src="{{ $logo }}" alt="Logo" class="h-10 w-auto">
                    @else
                        Mindu
                    @endif
                </span>
            </a>
            <div x-show="sidebarMinimized" class="flex justify-center w-full">
                 <span class="text-2xl font-bold text-blue-600">M</span>
            </div>
            <!-- Toggle Button (Desktop) -->
            <button @click="sidebarMinimized = !sidebarMinimized" :class="sidebarMinimized ? 'hidden' : 'md:flex'" class="p-1.5 rounded-lg bg-slate-50 dark:bg-slate-700 text-slate-500 hover:text-blue-600 transition-colors">
                <svg class="w-5 h-5 transition-transform duration-300" :class="sidebarMinimized ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path></svg>
            </button>
            <!-- Close Button (Mobile Only) -->
            <button @click="sidebarOpen = false" class="md:hidden text-slate-500 hover:text-slate-900 dark:hover:text-white ml-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        @if(isset($sidebarMinimized) && $sidebarMinimized)
            <!-- Floating toggle helper for minimized state -->
            <button @click="sidebarMinimized = false" x-show="sidebarMinimized" class="hidden md:flex absolute -right-3 top-24 w-6 h-6 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-full items-center justify-center text-slate-400 transition hover:text-blue-600 shadow-sm z-50">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
            </button>
        @endif

        <nav class="flex-grow px-4 space-y-1 overflow-y-auto overflow-x-hidden pt-4">
            <a href="/admin" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg group {{ request()->is('admin') ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50 hover:text-slate-900 dark:hover:text-slate-200 transition' }}" :title="sidebarMinimized ? 'Dashboard' : ''">
                <svg class="w-5 h-5 shrink-0" :class="sidebarMinimized ? '' : 'mr-3'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span x-show="!sidebarMinimized" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-x-2" x-transition:enter-end="opacity-100 translate-x-0">Dashboard</span>
            </a>
            <a href="/admin/questions" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg group {{ request()->is('admin/questions*') ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50 hover:text-slate-900 dark:hover:text-slate-200 transition' }}" :title="sidebarMinimized ? 'Tambah Soal' : ''">
                <svg class="w-5 h-5 shrink-0" :class="sidebarMinimized ? '' : 'mr-3'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span x-show="!sidebarMinimized" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-x-2" x-transition:enter-end="opacity-100 translate-x-0">Tambah Soal</span>
            </a>
            <a href="/admin/users" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg group {{ request()->is('admin/users*') ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50 hover:text-slate-900 dark:hover:text-slate-200 transition' }}" :title="sidebarMinimized ? 'Manajemen User' : ''">
                <svg class="w-5 h-5 shrink-0" :class="sidebarMinimized ? '' : 'mr-3'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                <span x-show="!sidebarMinimized" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-x-2" x-transition:enter-end="opacity-100 translate-x-0">Manajemen User</span>
            </a>
            <a href="/admin/results" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg group {{ request()->is('admin/results*') ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50 hover:text-slate-900 dark:hover:text-slate-200 transition' }}" :title="sidebarMinimized ? 'Hasil Tes' : ''">
                <svg class="w-5 h-5 shrink-0" :class="sidebarMinimized ? '' : 'mr-3'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                <span x-show="!sidebarMinimized" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-x-2" x-transition:enter-end="opacity-100 translate-x-0">Hasil Tes</span>
            </a>
            <a href="/admin/settings" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg group {{ request()->is('admin/settings*') ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50 hover:text-slate-900 dark:hover:text-slate-200 transition' }}" :title="sidebarMinimized ? 'Pengaturan' : ''">
                <svg class="w-5 h-5 shrink-0" :class="sidebarMinimized ? '' : 'mr-3'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <span x-show="!sidebarMinimized" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-x-2" x-transition:enter-end="opacity-100 translate-x-0">Pengaturan</span>
            </a>
            <a href="{{ route('admin.update-settings.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg group {{ request()->is('admin/update-settings*') ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50 hover:text-slate-900 dark:hover:text-slate-200 transition' }}" :title="sidebarMinimized ? 'Pengaturan Update' : ''">
                <svg class="w-5 h-5 shrink-0" :class="sidebarMinimized ? '' : 'mr-3'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                <span x-show="!sidebarMinimized" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-x-2" x-transition:enter-end="opacity-100 translate-x-0">Pengaturan Update</span>
            </a>
        </nav>
        <div class="p-4 border-t border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 transition-all duration-300">
            <!-- Theme Toggle Admin -->
            <div class="flex items-center justify-around mb-4 bg-slate-50 dark:bg-slate-900 rounded-lg p-1" :class="sidebarMinimized ? 'flex-col space-y-2' : ''">
                <button @click="darkMode = 'light'; applyTheme()" class="p-2 rounded-md transition-all" :class="darkMode === 'light' ? 'bg-white dark:bg-slate-800 shadow-sm text-blue-600 dark:text-blue-400' : 'text-slate-500 hover:text-slate-700 dark:text-slate-400'" :title="sidebarMinimized ? 'Mode Terang' : ''">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M16.95 16.95l.707.707M7.05 7.05l.707.707M12 8a4 4 0 100 8 4 4 0 000-8z"></path></svg>
                </button>
                <button @click="darkMode = 'dark'; applyTheme()" class="p-2 rounded-md transition-all" :class="darkMode === 'dark' ? 'bg-white dark:bg-slate-800 shadow-sm text-blue-600 dark:text-blue-400' : 'text-slate-500 hover:text-slate-700 dark:text-slate-400'" :title="sidebarMinimized ? 'Mode Gelap' : ''">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                </button>
                <button @click="darkMode = 'system'; applyTheme()" class="p-2 rounded-md transition-all" :class="darkMode === 'system' ? 'bg-white dark:bg-slate-800 shadow-sm text-blue-600 dark:text-blue-400' : 'text-slate-500 hover:text-slate-700 dark:text-slate-400'" :title="sidebarMinimized ? 'Mode Otomatis' : ''">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </button>
            </div>
            <div class="flex items-center space-x-3 px-4 py-2" :class="sidebarMinimized ? 'justify-center px-0' : ''">
                <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold text-xs shrink-0" :title="sidebarMinimized ? auth()->user()->full_name : ''">
                    {{ substr(auth()->user()->full_name, 0, 1) }}
                </div>
                <div class="flex-grow min-w-0" x-show="!sidebarMinimized" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-x-2" x-transition:enter-end="opacity-100 translate-x-0">
                    <p class="text-sm font-medium text-slate-900 dark:text-slate-100 truncate">{{ auth()->user()->full_name }}</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400 truncate">{{ auth()->user()->email }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 text-sm font-medium text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition overflow-hidden whitespace-nowrap" :class="sidebarMinimized ? 'px-0 flex justify-center' : ''">
                    <svg class="w-5 h-5" :class="sidebarMinimized ? '' : 'mr-3 inline'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    <span x-show="!sidebarMinimized" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-x-2" x-transition:enter-end="opacity-100 translate-x-0">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Mobile Header -->
    <div class="md:hidden fixed top-0 left-0 right-0 bg-white dark:bg-slate-800 border-b border-slate-200 dark:border-slate-700 z-40 flex items-center justify-between px-4 h-16">
         <a href="/admin" class="text-xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
            @if($logo = \App\Models\Setting::get('site_logo'))
                <img src="{{ $logo }}" alt="Logo" class="h-8 w-auto">
            @else
                Mindu
            @endif
        </a>
        <button @click="sidebarOpen = true" class="p-2 text-slate-600 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
        </button>
    </div>

    <!-- Main Content -->
    <main class="flex-grow pt-16 md:pt-0 overflow-x-hidden">
        <div class="p-4 md:p-8 max-w-7xl mx-auto">
            {{ $slot }}
        </div>
    </main>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
