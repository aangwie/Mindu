<x-admin-layout>
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <a href="{{ route('admin.users.index') }}" class="text-slate-400 dark:text-slate-500 hover:text-slate-600 dark:hover:text-slate-300 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="text-3xl font-bold text-slate-900 dark:text-white">Tambah User Baru</h2>
        </div>
        <p class="text-slate-600 dark:text-slate-400 font-medium">Isi form di bawah untuk menambahkan user baru ke sistem.</p>
    </div>

    @if ($errors->any())
        <div class="mb-6 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-400 px-4 py-3 rounded-xl">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            {{-- Account Info --}}
            <div class="bg-white dark:bg-slate-800 p-6 md:p-8 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-6 flex items-center">
                    <span class="w-2 h-6 bg-blue-600 rounded-full mr-3"></span>
                    Informasi Akun
                </h3>
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Username</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                            class="block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition dark:text-white">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                            class="block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition dark:text-white">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Password</label>
                        <input type="password" id="password" name="password" required
                            class="block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition dark:text-white">
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Konfirmasi Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            class="block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition dark:text-white">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="role" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Role</label>
                            <select id="role" name="role" required
                                class="block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition dark:text-white">
                                <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Siswa</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>
                        <div class="flex items-end pb-1">
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                    class="w-5 h-5 rounded border-slate-300 dark:border-slate-600 text-blue-600 focus:ring-blue-500 dark:bg-slate-900">
                                <span class="text-sm font-bold text-slate-700 dark:text-slate-300">Akun Aktif</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Profile Info --}}
            <div class="bg-white dark:bg-slate-800 p-6 md:p-8 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-6 flex items-center">
                    <span class="w-2 h-6 bg-indigo-600 rounded-full mr-3"></span>
                    Informasi Profil
                </h3>
                <div class="space-y-4">
                    <div>
                        <label for="full_name" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Nama Lengkap</label>
                        <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}" required
                            class="block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition dark:text-white">
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">No. Telepon</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                            class="block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition dark:text-white">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="pob" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Tempat Lahir</label>
                            <input type="text" id="pob" name="pob" value="{{ old('pob') }}"
                                class="block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition dark:text-white">
                        </div>
                        <div>
                            <label for="dob" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Tanggal Lahir</label>
                            <input type="date" id="dob" name="dob" value="{{ old('dob') }}"
                                class="block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition dark:text-white">
                        </div>
                    </div>
                    <div>
                        <label for="school_origin" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Asal Sekolah</label>
                        <input type="text" id="school_origin" name="school_origin" value="{{ old('school_origin') }}"
                            class="block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition dark:text-white">
                    </div>
                    <div>
                        <label for="current_school" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Sekolah Saat Ini</label>
                        <input type="text" id="current_school" name="current_school" value="{{ old('current_school') }}"
                            class="block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition dark:text-white">
                    </div>
                    <div>
                        <label for="nisn" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">NISN</label>
                        <input type="text" id="nisn" name="nisn" value="{{ old('nisn') }}"
                            class="block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition dark:text-white">
                    </div>
                    <div>
                        <label for="address" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Alamat</label>
                        <textarea id="address" name="address" rows="3"
                            class="block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition dark:text-white">{{ old('address') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 flex justify-end gap-3">
                <a href="{{ route('admin.users.index') }}" class="px-8 py-3 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 rounded-xl font-bold text-sm hover:bg-slate-50 dark:hover:bg-slate-700 transition">Batal</a>
                <button type="submit" class="px-12 py-3 bg-slate-900 dark:bg-white text-white dark:text-slate-900 rounded-xl font-bold text-sm tracking-widest hover:bg-slate-800 dark:hover:bg-slate-100 transition shadow-xl shadow-slate-200 dark:shadow-none uppercase">Simpan User</button>
            </div>
        </div>
    </form>
</x-admin-layout>
