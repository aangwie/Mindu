<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Mindu') }} - Siswa</title>
    
    @php $siteLogoFav = \App\Models\Setting::get('site_logo'); @endphp
    <link rel="icon" type="image/x-icon" href="{{ $siteLogoFav ?: asset('favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        [x-cloak] { display: none !important; }
        .sidebar-transition { transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1), transform 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .ml-transition { transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    </style>

    <script>
        // Theme: apply immediately before paint
        (function() {
            var theme = localStorage.getItem('theme') || 'system';
            if (theme === 'dark' || (theme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>
</head>
<body x-data="studentLayout()" x-init="init()" class="bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-slate-100 antialiased min-h-screen">
    
    <!-- Mobile Header -->
    <header class="lg:hidden bg-white dark:bg-slate-800 border-b border-slate-200 dark:border-slate-700 h-16 fixed top-0 left-0 right-0 z-40 flex items-center px-4 justify-between">
        <button @click="sidebarOpen = !sidebarOpen" class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>
        <span class="font-bold text-blue-600">Mindu</span>
        <div class="w-10"></div>
    </header>

    <!-- Mobile Backdrop -->
    <div x-show="sidebarOpen && !isDesktop" @click="sidebarOpen = false" 
         x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" 
         x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" 
         class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-40" style="display:none;"></div>

    <!-- Sidebar -->
    <aside :style="sidebarVisible ? 'transform: translateX(0)' : 'transform: translateX(-100%)'"
           :class="minimized ? 'w-20' : 'w-72'"
           class="sidebar-transition fixed inset-y-0 left-0 z-50 bg-white dark:bg-slate-800 border-r border-slate-200 dark:border-slate-700 h-full flex flex-col">
        
        <!-- Logo area -->
        <div class="h-20 flex items-center px-6 border-b border-slate-100 dark:border-slate-700/50 overflow-hidden">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white shrink-0 shadow-lg shadow-blue-500/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
                </div>
                <span x-show="!minimized" x-transition.opacity class="ml-4 font-bold text-xl tracking-tight text-slate-900 dark:text-white whitespace-nowrap">Mindu</span>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-grow py-6 px-3 space-y-2 overflow-y-auto">
            <x-student-nav-link :href="route('student.dashboard')" :active="request()->routeIs('student.dashboard')" icon="dashboard">Dashboard</x-student-nav-link>
            <x-student-nav-link :href="route('tes')" :active="request()->routeIs('tes*')" icon="test">Tes</x-student-nav-link>
            <x-student-nav-link :href="route('student.history')" :active="request()->routeIs('student.history')" icon="history">Hasil Tes</x-student-nav-link>
            <x-student-nav-link :href="route('student.profile')" :active="request()->routeIs('student.profile')" icon="user">Profil Saya</x-student-nav-link>
        </nav>

        <!-- Bottom Actions -->
        <div class="p-4 border-t border-slate-100 dark:border-slate-700/50 space-y-4">
            <!-- Theme Toggle - Minimized -->
            <div class="flex justify-center" x-show="minimized">
               <button @click="darkMode = darkMode === 'light' ? 'dark' : 'light'; applyTheme()" class="p-2.5 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-700 transition">
                   <svg x-show="darkMode !== 'dark'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                   <svg x-show="darkMode === 'dark'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M16.95 16.95l.707.707M7.05 7.05l.707.707M12 8a4 4 0 100 8 4 4 0 000-8z"></path></svg>
               </button>
            </div>
            <!-- Theme Toggle - Expanded -->
            <div x-show="!minimized" class="bg-slate-50 dark:bg-slate-900/50 rounded-2xl p-2 flex items-center justify-between">
                <button @click="darkMode = 'light'; applyTheme()" :class="darkMode === 'light' ? 'bg-white dark:bg-slate-800 shadow-sm text-blue-600' : 'text-slate-400'" class="flex-1 py-1.5 rounded-xl flex justify-center transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M16.95 16.95l.707.707M7.05 7.05l.707.707M12 8a4 4 0 100 8 4 4 0 000-8z"></path></svg></button>
                <button @click="darkMode = 'dark'; applyTheme()" :class="darkMode === 'dark' ? 'bg-white dark:bg-slate-800 shadow-sm text-blue-600' : 'text-slate-400'" class="flex-1 py-1.5 rounded-xl flex justify-center transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg></button>
                <button @click="darkMode = 'system'; applyTheme()" :class="darkMode === 'system' ? 'bg-white dark:bg-slate-800 shadow-sm text-blue-600' : 'text-slate-400'" class="flex-1 py-1.5 rounded-xl flex justify-center transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg></button>
            </div>

            <!-- User Info -->
            <div class="flex items-center px-2">
                <div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900/40 text-blue-600 flex items-center justify-center text-xs font-bold shrink-0">
                    {{ substr(auth()->user()->full_name, 0, 1) }}
                </div>
                <div x-show="!minimized" class="ml-3 overflow-hidden">
                    <p class="text-sm font-bold text-slate-800 dark:text-white truncate">{{ auth()->user()->name }}</p>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-[10px] text-slate-500 hover:text-red-600 transition font-bold uppercase tracking-wider">Keluar</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Minimize Button -->
        <button @click="toggleMinimize" class="hidden lg:flex absolute -right-3 top-24 w-6 h-6 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-full items-center justify-center text-slate-400 transition hover:text-blue-600 shadow-sm z-50">
            <svg :class="minimized ? '' : 'rotate-180'" class="w-3 h-3 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
        </button>
    </aside>

    <!-- Main Content -->
    <div :style="'margin-left: ' + mainMargin" class="ml-transition flex flex-col min-h-screen pt-16 lg:pt-0">
        <main class="flex-grow p-4 md:p-8">
            {{ $slot }}
        </main>
        
        <footer class="p-6 text-center text-slate-500 dark:text-slate-400 text-sm border-t border-slate-100 dark:border-slate-800">
            &copy; {{ date('Y') }} {{ config('app.name', 'Mindu') }}. Semua Hak Dilindungi.
        </footer>
    </div>

    <!-- Layout function (must be before Alpine) -->
    <script>
        function studentLayout() {
            return {
                darkMode: localStorage.getItem('theme') || 'system',
                sidebarOpen: false,
                isDesktop: window.innerWidth >= 1024,
                minimized: localStorage.getItem('student_sidebar_minimized') === 'true',

                get sidebarVisible() {
                    return this.isDesktop || this.sidebarOpen;
                },

                get mainMargin() {
                    if (!this.isDesktop) return '0px';
                    return this.minimized ? '5rem' : '18rem';
                },

                init() {
                    this.applyTheme();

                    window.addEventListener('resize', () => {
                        this.isDesktop = window.innerWidth >= 1024;
                    });

                    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                        if (this.darkMode === 'system') this.applyTheme();
                    });

                    this.$watch('minimized', value => localStorage.setItem('student_sidebar_minimized', value));
                },

                applyTheme() {
                    if (this.darkMode === 'dark' || (this.darkMode === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                    localStorage.setItem('theme', this.darkMode);
                },

                toggleMinimize() {
                    this.minimized = !this.minimized;
                }
            }
        }
    </script>
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
