<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin - {{ config('app.name', 'Mindu') }}</title>

    @php $siteLogoFav = \App\Models\Setting::get('site_logo'); @endphp
    <link rel="icon" type="image/x-icon" href="{{ $siteLogoFav ?: asset('favicon.ico') }}">

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
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        [x-cloak] { display: none !important; }
        .sidebar-transition { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    </style>
</head>
<body x-data="{ 
    darkMode: localStorage.getItem('theme') || 'system',
    sidebarOpen: window.innerWidth > 1024,
    minimized: localStorage.getItem('admin_sidebar_minimized') === 'true',
    init() {
        this.applyTheme();
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
            if (this.darkMode === 'system') this.applyTheme();
        });
        window.addEventListener('resize', () => {
            if (window.innerWidth > 1024) this.sidebarOpen = true;
        });
        this.$watch('minimized', value => localStorage.setItem('admin_sidebar_minimized', value));
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
}" class="bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-slate-100 antialiased transition-colors duration-300 min-h-screen">
    
    <!-- Mobile Header -->
    <header class="lg:hidden bg-white dark:bg-slate-800 border-b border-slate-200 dark:border-slate-700 h-16 fixed top-0 left-0 right-0 z-40 flex items-center px-4 justify-between">
        <button @click="sidebarOpen = !sidebarOpen" class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>
        <span class="font-bold text-blue-600">
            @if($logo = \App\Models\Setting::get('site_logo'))
                <img src="{{ $logo }}" alt="Logo" class="h-8 w-auto">
            @else
                Admin Panel
            @endif
        </span>
        <div class="w-10"></div>
    </header>

    <!-- Sidebar Wrapper -->
    <div class="fixed inset-y-0 left-0 z-50 flex">
        <!-- Backdrop for mobile -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm lg:hidden"></div>

        <!-- Sidebar -->
        <aside x-show="sidebarOpen" 
               x-transition:enter="transition ease-in-out duration-300 transform" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
               :class="minimized ? 'w-20' : 'w-72'"
               class="sidebar-transition bg-white dark:bg-slate-800 border-r border-slate-200 dark:border-slate-700 h-full flex flex-col relative">
            
            <!-- Logo area -->
            <div class="h-20 flex items-center px-6 border-b border-slate-100 dark:border-slate-700/50 overflow-hidden">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center text-white shrink-0 shadow-lg shadow-blue-500/20">
                        @if($logo = \App\Models\Setting::get('site_logo'))
                            <img src="{{ $logo }}" alt="Logo" class="h-7 w-7 object-contain">
                        @else
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        @endif
                    </div>
                    <span x-show="!minimized" x-transition.opacity class="ml-4 font-bold text-xl tracking-tight text-slate-900 dark:text-white whitespace-nowrap">Admin Panel</span>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-grow py-6 px-3 space-y-1 overflow-y-auto overflow-x-hidden">
                <p x-show="!minimized" class="px-4 mb-3 text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest">Menu Utama</p>
                
                <a href="/admin" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl group transition-all {{ request()->is('admin') && !request()->is('admin/*') ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 shadow-sm' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50 hover:text-slate-900 dark:hover:text-slate-200' }}" :title="minimized ? 'Dashboard' : ''">
                    <svg class="w-5 h-5 shrink-0" :class="minimized ? '' : 'mr-3'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span x-show="!minimized" x-transition.opacity>Dashboard</span>
                </a>
                <a href="/admin/questions" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl group transition-all {{ request()->is('admin/questions*') ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 shadow-sm' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50 hover:text-slate-900 dark:hover:text-slate-200' }}" :title="minimized ? 'Kelola Soal' : ''">
                    <svg class="w-5 h-5 shrink-0" :class="minimized ? '' : 'mr-3'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span x-show="!minimized" x-transition.opacity>Kelola Soal</span>
                </a>
                <a href="/admin/users" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl group transition-all {{ request()->is('admin/users*') ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 shadow-sm' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50 hover:text-slate-900 dark:hover:text-slate-200' }}" :title="minimized ? 'Manajemen Siswa' : ''">
                    <svg class="w-5 h-5 shrink-0" :class="minimized ? '' : 'mr-3'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <span x-show="!minimized" x-transition.opacity>Manajemen Siswa</span>
                </a>
                <a href="/admin/results" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl group transition-all {{ request()->is('admin/results*') ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 shadow-sm' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50 hover:text-slate-900 dark:hover:text-slate-200' }}" :title="minimized ? 'Hasil Tes' : ''">
                    <svg class="w-5 h-5 shrink-0" :class="minimized ? '' : 'mr-3'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    <span x-show="!minimized" x-transition.opacity>Hasil Tes</span>
                </a>

                <p x-show="!minimized" class="px-4 mt-6 mb-3 text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest">Konfigurasi</p>
                <div x-show="minimized" class="my-3 mx-4 border-t border-slate-200 dark:border-slate-700"></div>

                <a href="/admin/settings" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl group transition-all {{ request()->is('admin/settings*') ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 shadow-sm' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50 hover:text-slate-900 dark:hover:text-slate-200' }}" :title="minimized ? 'Pengaturan' : ''">
                    <svg class="w-5 h-5 shrink-0" :class="minimized ? '' : 'mr-3'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <span x-show="!minimized" x-transition.opacity>Pengaturan</span>
                </a>
                <a href="{{ route('admin.update-settings.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl group transition-all {{ request()->is('admin/update-settings*') ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 shadow-sm' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50 hover:text-slate-900 dark:hover:text-slate-200' }}" :title="minimized ? 'Update Sistem' : ''">
                    <svg class="w-5 h-5 shrink-0" :class="minimized ? '' : 'mr-3'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    <span x-show="!minimized" x-transition.opacity>Update Sistem</span>
                </a>
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
                    <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs font-bold shrink-0">
                        {{ substr(auth()->user()->full_name, 0, 1) }}
                    </div>
                    <div x-show="!minimized" class="ml-3 overflow-hidden">
                        <p class="text-sm font-bold text-slate-800 dark:text-white truncate">{{ auth()->user()->full_name }}</p>
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
    </div>

    <!-- Main Content -->
    <div :class="sidebarOpen ? (minimized ? 'lg:ml-20' : 'lg:ml-72') : ''" class="sidebar-transition flex flex-col min-h-screen pt-16 lg:pt-0">
        <main class="flex-grow p-4 md:p-8 max-w-7xl mx-auto w-full">
            {{ $slot }}
        </main>
        
        <footer class="p-6 text-center text-slate-500 dark:text-slate-400 text-sm border-t border-slate-100 dark:border-slate-800">
            &copy; {{ date('Y') }} {{ config('app.name', 'Mindu') }}. Admin Panel.
        </footer>
    </div>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
