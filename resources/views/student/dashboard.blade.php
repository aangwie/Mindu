<x-student-layout>
    <div class="max-w-6xl mx-auto space-y-8">
        <!-- Welcome Section -->
        <div class="bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 rounded-2xl p-8 md:p-10 text-white relative overflow-hidden shadow-xl">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/4"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/4"></div>
            <div class="relative z-10">
                <p class="text-blue-200 text-sm font-semibold uppercase tracking-widest mb-2">Selamat Datang</p>
                <h1 class="text-3xl md:text-4xl font-extrabold mb-2">{{ $user->full_name }}</h1>
                <p class="text-blue-100/80 text-sm md:text-base">{{ $user->current_school ?? 'Siswa Mindu' }}</p>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Total Tes -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 p-6 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-12 h-12 bg-emerald-100 dark:bg-emerald-900/30 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <p class="text-3xl font-extrabold text-slate-900 dark:text-white">{{ $totalTests }}</p>
                <p class="text-sm text-slate-500 dark:text-slate-400 font-medium mt-1">Total Tes Selesai</p>
            </div>

            <!-- Tes Terakhir -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 p-6 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <p class="text-xl font-extrabold text-slate-900 dark:text-white">
                    @if($lastResult)
                        {{ $lastResult->created_at->format('d M Y') }}
                    @else
                        <span class="text-slate-400">-</span>
                    @endif
                </p>
                <p class="text-sm text-slate-500 dark:text-slate-400 font-medium mt-1">Tes Terakhir</p>
            </div>

            <!-- Status -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 p-6 shadow-sm hover:shadow-md transition-shadow sm:col-span-2 lg:col-span-1">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-12 h-12 {{ $hasTestInProgress ? 'bg-amber-100 dark:bg-amber-900/30' : 'bg-slate-100 dark:bg-slate-700' }} rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 {{ $hasTestInProgress ? 'text-amber-600 dark:text-amber-400' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                </div>
                <p class="text-xl font-extrabold text-slate-900 dark:text-white">
                    @if($hasTestInProgress)
                        Sedang Berjalan
                    @else
                        Tidak Ada
                    @endif
                </p>
                <p class="text-sm text-slate-500 dark:text-slate-400 font-medium mt-1">Tes Aktif</p>
            </div>
        </div>

        <!-- Profile Summary & Quick Actions -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Profile Card -->
            <div class="lg:col-span-2 bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 p-6 md:p-8 shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white flex items-center">
                        <span class="w-2 h-6 bg-blue-600 rounded-full mr-3"></span>
                        Informasi Profil
                    </h3>
                    <a href="{{ route('student.profile') }}" class="text-sm font-semibold text-blue-600 dark:text-blue-400 hover:underline">Edit</a>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Nama Lengkap</p>
                        <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $user->full_name }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">NISN</p>
                        <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $user->nisn ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Sekolah</p>
                        <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $user->current_school ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Email</p>
                        <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $user->email }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Tempat, Tanggal Lahir</p>
                        <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $user->pob ?? '-' }}, {{ $user->dob ? \Carbon\Carbon::parse($user->dob)->format('d M Y') : '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">No. HP</p>
                        <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $user->phone ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="space-y-4">
                <a href="{{ route('tes') }}" class="block bg-blue-600 hover:bg-blue-700 text-white rounded-2xl p-6 shadow-lg shadow-blue-500/20 transition-all hover:shadow-xl group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-bold text-lg">{{ $hasTestInProgress ? 'Lanjutkan Tes' : 'Mulai Tes' }}</p>
                            <p class="text-blue-200 text-sm mt-1">Psikotest Holland (RIASEC)</p>
                        </div>
                        <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </div>
                </a>
                <a href="{{ route('student.history') }}" class="block bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:border-blue-300 dark:hover:border-blue-600 rounded-2xl p-6 shadow-sm transition-all hover:shadow-md group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-bold text-slate-900 dark:text-white">Riwayat Tes</p>
                            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Lihat semua hasil tes</p>
                        </div>
                        <svg class="w-5 h-5 text-slate-400 group-hover:text-blue-600 dark:group-hover:text-blue-400 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-student-layout>
