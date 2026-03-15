<x-admin-layout>
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <a href="{{ route('admin.users.index') }}" class="text-slate-400 dark:text-slate-500 hover:text-slate-600 dark:hover:text-slate-300 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="text-3xl font-bold text-slate-900 dark:text-white">Detail User</h2>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Profile Card --}}
        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-slate-800 p-8 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm text-center">
                <div class="w-20 h-20 rounded-full {{ $user->role === 'admin' ? 'bg-violet-100 dark:bg-violet-900/30 text-violet-600 dark:text-violet-400' : 'bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' }} flex items-center justify-center text-3xl font-bold mx-auto mb-4">
                    {{ strtoupper(substr($user->full_name ?? $user->name, 0, 1)) }}
                </div>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white">{{ $user->full_name ?? $user->name }}</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400 mb-4">{{ $user->email }}</p>

                <div class="flex justify-center gap-2 mb-6">
                    @if($user->role === 'admin')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-violet-100 dark:bg-violet-900/40 text-violet-700 dark:text-violet-400">Admin</span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-400">Siswa</span>
                    @endif
                    @if($user->is_active)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-400">Aktif</span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-400">Nonaktif</span>
                    @endif
                </div>

                <div class="flex gap-2">
                    <a href="{{ route('admin.users.edit', $user) }}" class="flex-1 py-2.5 bg-amber-500 hover:bg-amber-600 text-white font-semibold rounded-xl transition text-sm text-center">Edit</a>
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="flex-1" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full py-2.5 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-xl transition text-sm">Hapus</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Detail Info --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Account Information --}}
            <div class="bg-white dark:bg-slate-800 p-6 md:p-8 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-6 flex items-center">
                    <span class="w-2 h-6 bg-blue-600 rounded-full mr-3"></span>
                    Informasi Akun
                </h3>
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                    <div>
                        <dt class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Username</dt>
                        <dd class="text-sm font-medium text-slate-900 dark:text-white">{{ $user->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Email</dt>
                        <dd class="text-sm font-medium text-slate-900 dark:text-white">{{ $user->email }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Bergabung Sejak</dt>
                        <dd class="text-sm font-medium text-slate-900 dark:text-white">{{ $user->created_at->translatedFormat('d F Y, H:i') }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Terakhir Diperbarui</dt>
                        <dd class="text-sm font-medium text-slate-900 dark:text-white">{{ $user->updated_at->translatedFormat('d F Y, H:i') }}</dd>
                    </div>
                </dl>
            </div>

            {{-- Profile Information --}}
            <div class="bg-white dark:bg-slate-800 p-6 md:p-8 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-6 flex items-center">
                    <span class="w-2 h-6 bg-indigo-600 rounded-full mr-3"></span>
                    Informasi Profil
                </h3>
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                    <div>
                        <dt class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Nama Lengkap</dt>
                        <dd class="text-sm font-medium text-slate-900 dark:text-white">{{ $user->full_name ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">No. Telepon</dt>
                        <dd class="text-sm font-medium text-slate-900 dark:text-white">{{ $user->phone ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Tempat Lahir</dt>
                        <dd class="text-sm font-medium text-slate-900 dark:text-white">{{ $user->pob ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Tanggal Lahir</dt>
                        <dd class="text-sm font-medium text-slate-900 dark:text-white">{{ $user->dob ? \Carbon\Carbon::parse($user->dob)->translatedFormat('d F Y') : '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Asal Sekolah</dt>
                        <dd class="text-sm font-medium text-slate-900 dark:text-white">{{ $user->school_origin ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Sekolah Saat Ini</dt>
                        <dd class="text-sm font-medium text-slate-900 dark:text-white">{{ $user->current_school ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">NISN</dt>
                        <dd class="text-sm font-medium text-slate-900 dark:text-white">{{ $user->nisn ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Jumlah Sesi Tes</dt>
                        <dd class="text-sm font-medium text-slate-900 dark:text-white">{{ $user->test_sessions_count ?? 0 }}</dd>
                    </div>
                    <div class="md:col-span-2">
                        <dt class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Alamat</dt>
                        <dd class="text-sm font-medium text-slate-900 dark:text-white">{{ $user->address ?? '-' }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</x-admin-layout>
