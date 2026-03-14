<x-admin-layout>
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-slate-900">Dashboard</h2>
        <p class="text-slate-600 font-medium">Selamat datang kembali, {{ auth()->user()->full_name }}. Berikut ringkasan sistem hari ini.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Students -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-blue-50 text-blue-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
            </div>
            <h3 class="text-slate-500 text-sm font-bold uppercase tracking-wider">Total Siswa</h3>
            <p class="text-3xl font-bold text-slate-900 mt-1">{{ $totalStudents }}</p>
        </div>

        <!-- Completed Tests -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <h3 class="text-slate-500 text-sm font-bold uppercase tracking-wider">Siswa Sudah Tes</h3>
            <p class="text-3xl font-bold text-slate-900 mt-1">{{ $completedTests }}</p>
        </div>

        <!-- SMA Recommendation -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-violet-50 text-violet-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-7h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
            </div>
            <h3 class="text-slate-500 text-sm font-bold uppercase tracking-wider">Disarankan ke SMA</h3>
            <p class="text-3xl font-bold text-slate-900 mt-1">{{ $smaCount }}</p>
        </div>

        <!-- SMK Recommendation -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-amber-50 text-amber-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
            </div>
            <h3 class="text-slate-500 text-sm font-bold uppercase tracking-wider">Disarankan ke SMK</h3>
            <p class="text-3xl font-bold text-slate-900 mt-1">{{ $smkCount }}</p>
        </div>
    </div>

    <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm">
        <h3 class="text-lg font-bold text-slate-900 mb-4">Aksi Cepat</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('admin.questions.create') }}" class="flex items-center p-4 bg-slate-50 rounded-xl hover:bg-blue-50 hover:text-blue-700 transition group border border-transparent hover:border-blue-100">
                <div class="p-2 bg-white rounded-lg shadow-sm mr-3 group-hover:shadow text-slate-500 group-hover:text-blue-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                </div>
                <span class="font-bold">Tambah Soal Baru</span>
            </a>
            <a href="{{ route('admin.users.index') }}" class="flex items-center p-4 bg-slate-50 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 transition group border border-transparent hover:border-emerald-100">
                <div class="p-2 bg-white rounded-lg shadow-sm mr-3 group-hover:shadow text-slate-500 group-hover:text-emerald-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <span class="font-bold">Lihat Data Siswa</span>
            </a>
            <a href="{{ route('admin.results.index') }}" class="flex items-center p-4 bg-slate-50 rounded-xl hover:bg-violet-50 hover:text-violet-700 transition group border border-transparent hover:border-violet-100">
                <div class="p-2 bg-white rounded-lg shadow-sm mr-3 group-hover:shadow text-slate-500 group-hover:text-violet-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <span class="font-bold">Pantau Hasil Tes</span>
            </a>
        </div>
    </div>
</x-admin-layout>
