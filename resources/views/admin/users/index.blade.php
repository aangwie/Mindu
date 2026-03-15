<x-admin-layout>
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-3xl font-bold text-slate-900 dark:text-white">Manajemen User</h2>
            <p class="text-slate-600 dark:text-slate-400 font-medium">Lihat dan kelola semua data pengguna yang terdaftar.</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition shadow-sm">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah User
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-400 px-4 py-3 rounded-xl flex items-center shadow-sm">
            <div class="shrink-0 mr-3">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
            </div>
            <p class="text-sm font-bold">{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-400 px-4 py-3 rounded-xl flex items-center shadow-sm">
            <div class="shrink-0 mr-3">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v4a1 1 0 102 0V7zm-1 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" /></svg>
            </div>
            <p class="text-sm font-bold">{{ session('error') }}</p>
        </div>
    @endif

    <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-900/50 border-b border-slate-200 dark:border-slate-700">
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest">User</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest">Role</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest">NISN / Sekolah</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest">Status</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                    @if(count($users) > 0)
                        @foreach($users as $user)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition duration-150">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-full {{ $user->role === 'admin' ? 'bg-violet-100 dark:bg-violet-900/30 text-violet-600 dark:text-violet-400' : 'bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' }} flex items-center justify-center font-bold mr-3">
                                            {{ strtoupper(substr($user->full_name ?? $user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-slate-900 dark:text-white">{{ $user->full_name ?? $user->name }}</p>
                                            <p class="text-xs text-slate-500 dark:text-slate-400">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($user->role === 'admin')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-violet-100 dark:bg-violet-900/40 text-violet-700 dark:text-violet-400">Admin</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-400">Siswa</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm font-medium text-slate-700 dark:text-slate-300">{{ $user->nisn ?? '-' }}</p>
                                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ $user->current_school ?? '-' }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    @if($user->is_active)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-400">Aktif</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-400">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center items-center gap-1">
                                        {{-- Detail --}}
                                        <a href="{{ route('admin.users.show', $user) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 transition p-2 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-lg" title="Detail">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        </a>
                                        {{-- Edit --}}
                                        <a href="{{ route('admin.users.edit', $user) }}" class="text-amber-600 dark:text-amber-400 hover:text-amber-900 dark:hover:text-amber-300 transition p-2 hover:bg-amber-50 dark:hover:bg-amber-900/30 rounded-lg" title="Edit">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        {{-- Hapus --}}
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini? Semua data terkait akan ikut terhapus.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 transition p-2 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg" title="Hapus">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-slate-200 dark:text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                    <p class="text-slate-500 dark:text-slate-400 font-medium">Belum ada user yang terdaftar.</p>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-900/30">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>
