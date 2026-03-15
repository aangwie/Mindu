<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-12">
        <div class="bg-white dark:bg-slate-800 p-8 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-extrabold text-slate-900 dark:text-white">
                    Daftar Akun Baru
                </h2>
                <p class="mt-2 text-sm text-slate-600 dark:text-slate-400">
                    Sudah punya akun? <a href="{{ route('login') }}" class="font-medium text-blue-600 dark:text-blue-400 hover:text-blue-500">Masuk di sini</a>
                </p>
            </div>

            @if ($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <ul class="list-disc list-inside text-sm text-red-700">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('register.post') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @csrf
                
                <!-- Account Info -->
                <div class="md:col-span-2 border-b border-slate-100 dark:border-slate-700 pb-2 mb-2">
                    <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-200">Informasi Akun</h3>
                </div>

                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Username</label>
                    <input id="name" name="name" type="text" required value="{{ old('name') }}"
                        class="mt-1 block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150 text-slate-900 dark:text-white">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Email Address</label>
                    <input id="email" name="email" type="email" required value="{{ old('email') }}"
                        class="mt-1 block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150 text-slate-900 dark:text-white">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Password</label>
                    <div class="relative mt-1" x-data="{ show: false }">
                        <input id="password" name="password" :type="show ? 'text' : 'password'" required
                            class="block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150 dark:text-white pr-10">
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 dark:text-slate-500 hover:text-slate-600 dark:hover:text-slate-300 transition">
                            <svg x-show="!show" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            <svg x-show="show" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 1.053 0 2.062.18 3 .512M7.943 7.943L16.057 16.057M10.788 10.788L13.212 13.212M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18"></path></svg>
                        </button>
                    </div>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Konfirmasi Password</label>
                    <div class="relative mt-1" x-data="{ show: false }">
                        <input id="password_confirmation" name="password_confirmation" :type="show ? 'text' : 'password'" required
                            class="block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150 dark:text-white pr-10">
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 dark:text-slate-500 hover:text-slate-600 dark:hover:text-slate-300 transition">
                            <svg x-show="!show" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            <svg x-show="show" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 1.053 0 2.062.18 3 .512M7.943 7.943L16.057 16.057M10.788 10.788L13.212 13.212M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18"></path></svg>
                        </button>
                    </div>
                </div>

                <!-- Personal Info -->
                <div class="md:col-span-2 border-b border-slate-100 dark:border-slate-700 pb-2 mb-2 mt-4">
                    <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-200">Profil Lengkap</h3>
                </div>

                <div>
                    <label for="full_name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Nama Lengkap</label>
                    <input id="full_name" name="full_name" type="text" required value="{{ old('full_name') }}"
                        class="mt-1 block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150 text-slate-900 dark:text-white">
                </div>

                <div>
                    <label for="nisn" class="block text-sm font-medium text-slate-700 dark:text-slate-300">NISN</label>
                    <input id="nisn" name="nisn" type="text" required value="{{ old('nisn') }}"
                        class="mt-1 block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150 text-slate-900 dark:text-white">
                </div>

                <div>
                    <label for="current_school" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Nama Sekolah Saat Ini</label>
                    <input id="current_school" name="current_school" type="text" required value="{{ old('current_school') }}"
                        class="mt-1 block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150 text-slate-900 dark:text-white">
                </div>

                <div>
                    <label for="school_origin" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Asal Sekolah (Target Lanjutan)</label>
                    <input id="school_origin" name="school_origin" type="text" required value="{{ old('school_origin') }}"
                        class="mt-1 block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150 text-slate-900 dark:text-white">
                </div>

                <div>
                    <label for="pob" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Tempat Lahir</label>
                    <input id="pob" name="pob" type="text" required value="{{ old('pob') }}"
                        class="mt-1 block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150 text-slate-900 dark:text-white">
                </div>

                <div>
                    <label for="dob" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Tanggal Lahir</label>
                    <input id="dob" name="dob" type="date" required value="{{ old('dob') }}"
                        class="mt-1 block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150 text-slate-900 dark:text-white">
                </div>

                <div class="md:col-span-2">
                    <label for="phone" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Nomor HP (Opsional)</label>
                    <input id="phone" name="phone" type="text" value="{{ old('phone') }}"
                        class="mt-1 block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150 text-slate-900 dark:text-white">
                </div>

                <div class="md:col-span-2">
                    <label for="address" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Alamat Rumah</label>
                    <textarea id="address" name="address" rows="3" required
                        class="mt-1 block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150 text-slate-900 dark:text-white">{{ old('address') }}</textarea>
                </div>

                <div class="md:col-span-2 mt-6">
                    <button type="submit"
                        class="w-full flex justify-center py-4 px-4 border border-transparent text-sm font-bold rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 uppercase tracking-widest">
                        Daftar & Lanjut Ke Psikotest
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
