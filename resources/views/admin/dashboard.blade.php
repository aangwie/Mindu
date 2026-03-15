<x-admin-layout>
    {{-- Vite Dev Server Status Indicator --}}
    <div x-data="viteStatus()" x-init="checkVite()" class="mb-6">
        {{-- Warning Banner (Vite NOT running) --}}
        <div x-show="status === 'down'" x-cloak
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             style="background: linear-gradient(135deg, #fee2e2, #fecaca); border: 1px solid #f87171; border-radius: 16px; padding: 16px 20px; display: flex; align-items: flex-start; gap: 14px; box-shadow: 0 4px 12px rgba(239, 68, 68, 0.15);">
            {{-- Animated pulse icon --}}
            <div style="position: relative; flex-shrink: 0; margin-top: 2px;">
                <span style="display: block; width: 12px; height: 12px; background: #ef4444; border-radius: 50%; animation: pulse-red 1.5s ease-in-out infinite;"></span>
                <span style="position: absolute; top: -4px; left: -4px; width: 20px; height: 20px; background: rgba(239, 68, 68, 0.3); border-radius: 50%; animation: ping-red 1.5s cubic-bezier(0, 0, 0.2, 1) infinite;"></span>
            </div>
            <div style="flex: 1;">
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
                    <span style="font-weight: 700; font-size: 14px; color: #991b1b;">⚠️ Vite Dev Server Tidak Aktif</span>
                </div>
                <p style="font-size: 13px; color: #b91c1c; margin: 0 0 8px 0; line-height: 1.5;">
                    <strong>npm run dev</strong> belum dijalankan. Sidebar dan beberapa fitur UI tidak akan berfungsi dengan baik.
                </p>
                <div style="background: #7f1d1d; border-radius: 8px; padding: 8px 14px; font-family: 'Courier New', monospace; font-size: 13px; color: #fca5a5; display: inline-block;">
                    <span style="color: #86efac;">$</span> npm run dev
                </div>
            </div>
        </div>

        {{-- Success Banner (Vite IS running) --}}
        <div x-show="status === 'up'" x-cloak
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 rounded-2xl px-5 py-3 flex items-center gap-3">
            <span class="relative flex h-3 w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
            </span>
            <span class="text-sm font-semibold text-emerald-700 dark:text-emerald-400">
                ✅ Vite Dev Server Aktif
            </span>
            <span class="text-xs text-emerald-500 dark:text-emerald-500 ml-auto">
                npm run dev berjalan
            </span>
        </div>

        {{-- Checking Banner --}}
        <div x-show="status === 'checking'" x-cloak
             class="bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl px-5 py-3 flex items-center gap-3">
            <svg class="animate-spin h-4 w-4 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
            </svg>
            <span class="text-sm text-slate-500 dark:text-slate-400">Memeriksa status Vite Dev Server...</span>
        </div>

        <style>
            @keyframes pulse-red {
                0%, 100% { opacity: 1; }
                50% { opacity: 0.5; }
            }
            @keyframes ping-red {
                75%, 100% { transform: scale(2); opacity: 0; }
            }
        </style>
    </div>

    <div class="mb-8">
        <h2 class="text-3xl font-bold text-slate-900 dark:text-white">Dashboard</h2>
        <p class="text-slate-600 dark:text-slate-400 font-medium">Selamat datang kembali, {{ auth()->user()->full_name }}. Berikut ringkasan sistem hari ini.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Students -->
        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
            </div>
            <h3 class="text-slate-500 dark:text-slate-400 text-sm font-bold uppercase tracking-wider">Total Siswa</h3>
            <p class="text-3xl font-bold text-slate-900 dark:text-white mt-1">{{ $totalStudents }}</p>
        </div>

        <!-- Completed Tests -->
        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <h3 class="text-slate-500 dark:text-slate-400 text-sm font-bold uppercase tracking-wider">Siswa Sudah Tes</h3>
            <p class="text-3xl font-bold text-slate-900 dark:text-white mt-1">{{ $completedTests }}</p>
        </div>

        <!-- SMA Recommendation -->
        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-violet-50 dark:bg-violet-900/30 text-violet-600 dark:text-violet-400 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-7h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
            </div>
            <h3 class="text-slate-500 dark:text-slate-400 text-sm font-bold uppercase tracking-wider">Disarankan ke SMA</h3>
            <p class="text-3xl font-bold text-slate-900 dark:text-white mt-1">{{ $smaCount }}</p>
        </div>

        <!-- SMK Recommendation -->
        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-amber-50 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
            </div>
            <h3 class="text-slate-500 dark:text-slate-400 text-sm font-bold uppercase tracking-wider">Disarankan ke SMK</h3>
            <p class="text-3xl font-bold text-slate-900 dark:text-white mt-1">{{ $smkCount }}</p>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-800 p-8 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm">
        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Aksi Cepat</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('admin.questions.create') }}" class="flex items-center p-4 bg-slate-50 dark:bg-slate-900/50 rounded-xl hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:text-blue-700 dark:hover:text-blue-400 transition group border border-transparent hover:border-blue-100 dark:hover:border-blue-800">
                <div class="p-2 bg-white dark:bg-slate-700 rounded-lg shadow-sm mr-3 group-hover:shadow text-slate-500 dark:text-slate-400 group-hover:text-blue-600 dark:group-hover:text-blue-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                </div>
                <span class="font-bold text-slate-700 dark:text-slate-300 group-hover:text-blue-700 dark:group-hover:text-blue-400">Tambah Soal Baru</span>
            </a>
            <a href="{{ route('admin.users.index') }}" class="flex items-center p-4 bg-slate-50 dark:bg-slate-900/50 rounded-xl hover:bg-emerald-50 dark:hover:bg-emerald-900/20 hover:text-emerald-700 dark:hover:text-emerald-400 transition group border border-transparent hover:border-emerald-100 dark:hover:border-emerald-800">
                <div class="p-2 bg-white dark:bg-slate-700 rounded-lg shadow-sm mr-3 group-hover:shadow text-slate-500 dark:text-slate-400 group-hover:text-emerald-600 dark:group-hover:text-emerald-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <span class="font-bold text-slate-700 dark:text-slate-300 group-hover:text-emerald-700 dark:group-hover:text-emerald-400">Lihat Data Siswa</span>
            </a>
            <a href="{{ route('admin.results.index') }}" class="flex items-center p-4 bg-slate-50 dark:bg-slate-900/50 rounded-xl hover:bg-violet-50 dark:hover:bg-violet-900/20 hover:text-violet-700 dark:hover:text-violet-400 transition group border border-transparent hover:border-violet-100 dark:hover:border-violet-800">
                <div class="p-2 bg-white dark:bg-slate-700 rounded-lg shadow-sm mr-3 group-hover:shadow text-slate-500 dark:text-slate-400 group-hover:text-violet-600 dark:group-hover:text-violet-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <span class="font-bold text-slate-700 dark:text-slate-300 group-hover:text-violet-700 dark:group-hover:text-violet-400">Pantau Hasil Tes</span>
            </a>
        </div>
    </div>

    {{-- Hidden probe element to test if Tailwind CSS is loaded --}}
    <div id="vite-probe" class="hidden bg-blue-500" style="position:absolute;width:0;height:0;overflow:hidden;pointer-events:none;"></div>

    <script>
        function viteStatus() {
            return {
                status: 'checking',
                intervalId: null,

                checkVite() {
                    // Small delay to let styles load
                    setTimeout(() => this.doCheck(), 500);
                    // Re-check every 10 seconds
                    this.intervalId = setInterval(() => this.doCheck(), 10000);
                },

                doCheck() {
                    // Method 1: Check if Vite HMR styles are injected (dev mode)
                    var viteHmrStyles = document.querySelectorAll('style[data-vite-dev-id]');
                    if (viteHmrStyles.length > 0) {
                        this.status = 'up';
                        return;
                    }

                    // Method 2: Check if built assets are loaded (production mode)
                    var builtAssets = document.querySelectorAll('link[href*="/build/"], script[src*="/build/"]');
                    if (builtAssets.length > 0) {
                        this.status = 'up';
                        return;
                    }

                    // Method 3: Check if Tailwind CSS is actually working
                    // Test by checking if our probe element has Tailwind-compiled styles
                    var probe = document.getElementById('vite-probe');
                    if (probe) {
                        var computed = window.getComputedStyle(probe);
                        var bgColor = computed.backgroundColor;
                        // bg-blue-500 should compile to rgb(59, 130, 246) if Tailwind is loaded
                        if (bgColor && bgColor !== 'rgba(0, 0, 0, 0)' && bgColor !== 'transparent') {
                            this.status = 'up';
                            return;
                        }
                    }

                    // If none of the checks passed, Vite/npm is not running
                    this.status = 'down';
                },

                destroy() {
                    if (this.intervalId) clearInterval(this.intervalId);
                }
            }
        }
    </script>

</x-admin-layout>
