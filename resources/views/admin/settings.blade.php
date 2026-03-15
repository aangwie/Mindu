<x-admin-layout>
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Pengaturan</h2>
        <p class="text-slate-500 dark:text-slate-400 font-medium">Kelola konfigurasi sistem dan profil admin Anda.</p>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-400 px-4 py-3 rounded-xl flex items-center shadow-sm">
            <div class="shrink-0 mr-3">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
            </div>
            <p class="text-sm font-bold">{{ session('success') }}</p>
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-6 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-400 px-4 py-3 rounded-xl">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Admin Profile -->
            <div class="space-y-6">
                <div class="bg-white dark:bg-slate-800 p-6 md:p-8 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm h-full">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-6 flex items-center">
                        <span class="w-2 h-6 bg-blue-600 rounded-full mr-3"></span>
                        Profil Admin
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="email" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Email Login</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $admin->email) }}" required
                                class="block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition dark:text-white">
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Password Baru (Kosongkan jika tidak diubah)</label>
                            <div class="relative" x-data="{ show: false }">
                                <input :type="show ? 'text' : 'password'" id="password" name="password"
                                    class="block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition dark:text-white pr-10">
                                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 dark:text-slate-500 hover:text-slate-600 dark:hover:text-slate-300 transition">
                                    <svg x-show="!show" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    <svg x-show="show" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 1.053 0 2.062.18 3 .512M7.943 7.943L16.057 16.057M10.788 10.788L13.212 13.212M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18"></path></svg>
                                </button>
                            </div>
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Konfirmasi Password Baru</label>
                            <div class="relative" x-data="{ show: false }">
                                <input :type="show ? 'text' : 'password'" id="password_confirmation" name="password_confirmation"
                                    class="block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition dark:text-white pr-10">
                                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 dark:text-slate-500 hover:text-slate-600 dark:hover:text-slate-300 transition">
                                    <svg x-show="!show" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    <svg x-show="show" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 1.053 0 2.062.18 3 .512M7.943 7.943L16.057 16.057M10.788 10.788L13.212 13.212M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18"></path></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Site Settings -->
            <div class="space-y-6">
                <div class="bg-white dark:bg-slate-800 p-6 md:p-8 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-6 flex items-center">
                        <span class="w-2 h-6 bg-indigo-600 rounded-full mr-3"></span>
                        Informasi Pengembang (PDF)
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="site_logo" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Upload Logo Website</label>
                            @if($site_logo)
                                <div class="mb-4 p-2 border border-slate-100 dark:border-slate-700 rounded-lg bg-slate-50 dark:bg-slate-900 inline-block">
                                    <img src="{{ $site_logo }}" alt="Current Logo" class="h-12 w-auto">
                                    <p class="text-[10px] text-slate-400 dark:text-slate-500 mt-1">Logo saat ini</p>
                                </div>
                            @endif
                            <input type="file" id="site_logo" name="site_logo" accept="image/jpeg,image/png,image/jpg"
                                class="block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition dark:text-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 dark:file:bg-blue-900/30 file:text-blue-700 dark:file:text-blue-400 hover:file:bg-blue-100">
                            <p class="mt-2 text-[10px] text-slate-500 dark:text-slate-400 font-medium">Format: JPG, PNG, JPEG. Maksimum: 800 KB.</p>
                        </div>

                        <div>
                            <label for="site_favicon" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Favicon URL</label>
                            <input type="text" id="site_favicon" name="site_favicon" value="{{ old('site_favicon', $site_favicon) }}"
                                class="block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition dark:text-white">
                            <p class="mt-2 text-[10px] text-slate-500 dark:text-slate-400 font-medium">Contoh: /favicon.ico atau URL gambar kecil.</p>
                        </div>

                        <div>
                            <label for="site_address" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Alamat Pengembang</label>
                            <textarea id="site_address" name="site_address" rows="5" required
                                class="block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition dark:text-white">{{ old('site_address', $site_address) }}</textarea>
                            <p class="mt-2 text-[10px] text-slate-500 dark:text-slate-400 font-medium">Alamat ini akan muncul di bagian bawah PDF hasil tes.</p>
                        </div>

                        <div>
                            <label for="question_order" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Urutan Soal Tes</label>
                            <select id="question_order" name="question_order" required
                                class="block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition dark:text-white">
                                <option value="ordered" {{ (old('question_order', $question_order) == 'ordered') ? 'selected' : '' }}>Urut (Berdasarkan ID)</option>
                                <option value="random" {{ (old('question_order', $question_order) == 'random') ? 'selected' : '' }}>Acak (Randomize)</option>
                            </select>
                            <p class="mt-2 text-[10px] text-slate-500 dark:text-slate-400 font-medium">Pengaturan ini menentukan urutan soal yang muncul saat siswa mengerjakan tes.</p>
                        </div>
                    </div>
                </div>

                <!-- SMTP Settings -->
                <div class="bg-white dark:bg-slate-800 p-6 md:p-8 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-6 flex items-center">
                        <span class="w-2 h-6 bg-emerald-600 rounded-full mr-3"></span>
                        Konfigurasi SMTP (E-mail Aktivasi)
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="mail_host" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">SMTP Host</label>
                            <input type="text" id="mail_host" name="mail_host" value="{{ old('mail_host', $smtp['mail_host']) }}" placeholder="smtp.mailtrap.io"
                                class="block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition text-sm dark:text-white">
                        </div>
                        <div>
                            <label for="mail_port" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">SMTP Port</label>
                            <input type="text" id="mail_port" name="mail_port" value="{{ old('mail_port', $smtp['mail_port']) }}" placeholder="2525"
                                class="block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition text-sm dark:text-white">
                        </div>
                        <div>
                            <label for="mail_username" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">SMTP Username</label>
                            <input type="text" id="mail_username" name="mail_username" value="{{ old('mail_username', $smtp['mail_username']) }}"
                                class="block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition text-sm dark:text-white">
                        </div>
                        <div>
                            <label for="mail_password" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">SMTP Password</label>
                            <div class="relative" x-data="{ show: false }">
                                <input :type="show ? 'text' : 'password'" id="mail_password" name="mail_password" value="{{ old('mail_password', $smtp['mail_password']) }}"
                                    class="block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition text-sm dark:text-white pr-10">
                                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 dark:text-slate-500 hover:text-slate-600 dark:hover:text-slate-300 transition">
                                    <svg x-show="!show" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    <svg x-show="show" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 1.053 0 2.062.18 3 .512M7.943 7.943L16.057 16.057M10.788 10.788L13.212 13.212M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18"></path></svg>
                                </button>
                            </div>
                        </div>
                        <div>
                            <label for="mail_encryption" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Encryption</label>
                            <select id="mail_encryption" name="mail_encryption" 
                                class="block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition text-sm dark:text-white">
                                <option value="" {{ $smtp['mail_encryption'] == '' ? 'selected' : '' }}>None</option>
                                <option value="tls" {{ $smtp['mail_encryption'] == 'tls' ? 'selected' : '' }}>TLS</option>
                                <option value="ssl" {{ $smtp['mail_encryption'] == 'ssl' ? 'selected' : '' }}>SSL</option>
                            </select>
                        </div>
                        <div>
                            <label for="mail_from_address" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">From Email</label>
                            <input type="email" id="mail_from_address" name="mail_from_address" value="{{ old('mail_from_address', $smtp['mail_from_address']) }}" placeholder="noreply@mindu.id"
                                class="block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition text-sm dark:text-white">
                        </div>
                        <div class="md:col-span-2">
                            <label for="mail_from_name" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">From Name</label>
                            <input type="text" id="mail_from_name" name="mail_from_name" value="{{ old('mail_from_name', $smtp['mail_from_name']) }}" placeholder="Mindu Activation"
                                class="block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition text-sm dark:text-white">
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 flex justify-end">
                <button type="submit" class="px-12 py-4 bg-slate-900 dark:bg-white text-white dark:text-slate-900 rounded-xl font-bold text-sm tracking-widest hover:bg-slate-800 dark:hover:bg-slate-100 transition shadow-xl shadow-slate-200 dark:shadow-none uppercase">
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
</x-admin-layout>
