<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Mindu') }} - @yield('title', 'Tes Psikologi RIASEC')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        [x-cloak] { display: none !important; }
    </style>
    <script>
        // Initial theme check to prevent flash of un-themed content
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body x-data="{ 
    darkMode: localStorage.getItem('theme') || 'system',
    init() {
        this.applyTheme();
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
            if (this.darkMode === 'system') this.applyTheme();
        });
    },
    applyTheme() {
        if (this.darkMode === 'dark' || (this.darkMode === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
        localStorage.setItem('theme', this.darkMode);
    }
}" class="font-sans antialiased bg-[#f8fafc] dark:bg-slate-900 text-slate-900 dark:text-slate-100 flex flex-col min-h-screen transition-colors duration-300">
    
    <!-- Navbar -->
    <nav class="bg-white dark:bg-slate-800 border-b border-slate-200 dark:border-slate-700 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        @php $logo = \App\Models\Setting::get('site_logo'); @endphp
                        @if($logo)
                            <img src="{{ $logo }}" alt="Logo" class="h-8 w-auto">
                        @else
                            <div class="w-8 h-8 rounded bg-blue-600 flex items-center justify-center text-white font-bold text-lg">M</div>
                        @endif
                        <span class="font-black text-xl tracking-tight text-slate-800 dark:text-white">{{ config('app.name', 'Mindu') }}</span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden sm:flex sm:items-center sm:space-x-8">
                    <a href="{{ route('home') }}" class="text-sm font-semibold text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 transition">Beranda</a>
                    <a href="{{ route('about') }}" class="text-sm font-semibold text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 transition">Tentang Kami</a>
                    
                    <!-- Theme Toggle (Desktop) -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="p-2 text-slate-500 hover:text-blue-600 dark:text-slate-400 dark:hover:text-blue-400 transition-colors focus:outline-none">
                            <span x-show="darkMode === 'light'" x-cloak>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M16.95 16.95l.707.707M7.05 7.05l.707.707M12 8a4 4 0 100 8 4 4 0 000-8z"></path></svg>
                            </span>
                            <span x-show="darkMode === 'dark'" x-cloak>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                            </span>
                            <span x-show="darkMode === 'system'" x-cloak>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </span>
                        </button>
                        <div x-show="open" @click.away="open = false" x-cloak
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-36 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl shadow-lg py-2 z-50 overflow-hidden">
                            <button @click="darkMode = 'light'; applyTheme(); open = false" class="w-full text-left px-4 py-2 text-sm flex items-center space-x-2 hover:bg-slate-50 dark:hover:bg-slate-700 transition" :class="darkMode === 'light' ? 'text-blue-600 dark:text-blue-400 font-semibold' : 'text-slate-600 dark:text-slate-300'">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M16.95 16.95l.707.707M7.05 7.05l.707.707M12 8a4 4 0 100 8 4 4 0 000-8z"></path></svg>
                                <span>Terang</span>
                            </button>
                            <button @click="darkMode = 'dark'; applyTheme(); open = false" class="w-full text-left px-4 py-2 text-sm flex items-center space-x-2 hover:bg-slate-50 dark:hover:bg-slate-700 transition" :class="darkMode === 'dark' ? 'text-blue-600 dark:text-blue-400 font-semibold' : 'text-slate-600 dark:text-slate-300'">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                                <span>Gelap</span>
                            </button>
                            <button @click="darkMode = 'system'; applyTheme(); open = false" class="w-full text-left px-4 py-2 text-sm flex items-center space-x-2 hover:bg-slate-50 dark:hover:bg-slate-700 transition" :class="darkMode === 'system' ? 'text-blue-600 dark:text-blue-400 font-semibold' : 'text-slate-600 dark:text-slate-300'">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                <span>Otomatis</span>
                            </button>
                        </div>
                    </div>

                    @auth
                        <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('student.dashboard') }}" 
                           class="inline-flex items-center justify-center px-5 py-2 border border-transparent text-sm font-bold rounded-full text-white bg-blue-600 hover:bg-blue-700 transition shadow-sm">
                            Dashboard
                        </a>
                    @else
                        <div class="flex items-center space-x-4 ml-4 pl-4 border-l border-slate-200 dark:border-slate-700">
                            <a href="{{ route('login') }}" class="text-sm font-bold text-slate-700 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 transition">Masuk</a>
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-2 border border-transparent text-sm font-bold rounded-full text-slate-100 bg-slate-900 dark:bg-blue-600 hover:bg-slate-800 dark:hover:bg-blue-700 transition shadow-sm">
                                Daftar Gratis
                            </a>
                        </div>
                    @endauth
                </div>

                <!-- Mobile Menu Button & Theme Toggle -->
                <div class="flex items-center sm:hidden" x-data="{ open: false }">
                    <button @click="open = !open" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-slate-400 dark:text-slate-500 hover:text-slate-500 dark:hover:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 focus:outline-none transition" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Buka menu utama</span>
                        <!-- Icon when menu is closed -->
                        <svg x-show="!open" class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <!-- Icon when menu is open -->
                        <svg x-show="open" class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    
                    <!-- Mobile Menu Dropdown -->
                    <div x-show="open" @click.away="open = false" class="absolute top-16 right-0 w-full bg-white dark:bg-slate-800 border-b border-slate-200 dark:border-slate-700 shadow-lg sm:hidden" id="mobile-menu" style="display: none;">
                        <div class="px-4 py-2 border-b border-slate-100 dark:border-slate-700 flex justify-between items-center">
                            <span class="text-sm font-bold text-slate-700 dark:text-slate-300">Tema Gelap</span>
                            <button @click="darkMode = darkMode === 'dark' ? 'light' : 'dark'; applyTheme();" class="w-12 h-6 rounded-full bg-slate-200 dark:bg-blue-600 relative transition-colors duration-200 focus:outline-none">
                                <div class="w-5 h-5 rounded-full bg-white dark:bg-slate-100 absolute top-0.5 transition-transform duration-200 shadow-sm flex items-center justify-center transform" :class="darkMode === 'dark' ? 'translate-x-6' : 'translate-x-0.5'">
                                    <svg x-show="darkMode !== 'dark'" class="w-3 h-3 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd" /></svg>
                                    <svg x-show="darkMode === 'dark'" class="w-3 h-3 text-indigo-500" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" /></svg>
                                </div>
                            </button>
                        </div>
                        <div class="px-2 pt-2 pb-3 space-y-1">
                            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-slate-50 dark:hover:bg-slate-700/50">Beranda</a>
                            <a href="{{ route('about') }}" class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-slate-50 dark:hover:bg-slate-700/50">Tentang Kami</a>
                            <hr class="border-slate-100 dark:border-slate-700 my-2">
                            @auth
                                <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('student.dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-slate-700/50">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-slate-50 dark:hover:bg-slate-700/50">Masuk</a>
                                <a href="{{ route('register') }}" class="block px-3 py-2 rounded-md text-base font-medium text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-slate-700/50">Daftar</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>


    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 border-t border-slate-800 text-slate-300 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">
                <div>
                    <div class="flex items-center justify-center md:justify-start gap-2 mb-4">
                        <div class="w-8 h-8 rounded bg-blue-600 flex items-center justify-center text-white font-bold text-lg">M</div>
                        <span class="font-black text-xl tracking-tight text-white">{{ config('app.name', 'Mindu') }}</span>
                    </div>
                    <p class="text-sm text-slate-400 mb-4 max-w-xs mx-auto md:mx-0">
                        Platform tes psikologi online berbasis teori Holland RIASEC untuk membantu menemukan potensi dan karir masa depan Anda.
                    </p>
                </div>
                <div>
                    <h3 class="text-white font-bold mb-4 uppercase text-sm tracking-wider">Tautan Cepat</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-white transition">Tentang Kami</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-white transition">Masuk</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-white transition">Daftar Rekening</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-bold mb-4 uppercase text-sm tracking-wider">Legal</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('terms') }}" class="hover:text-white transition">Syarat & Ketentuan</a></li>
                    </ul>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-slate-800 text-center text-sm text-slate-500">
                &copy; {{ date('Y') }} {{ config('app.name', 'Mindu') }}. Hak Cipta Dilindungi Undang-Undang.
            </div>
        </div>
    </footer>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
