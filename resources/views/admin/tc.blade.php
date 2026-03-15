<x-admin-layout>
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Tentang Kami & Syarat Ketentuan</h2>
        <p class="text-slate-500 dark:text-slate-400 font-medium">Kelola konten halaman statis Tentang Kami (About Us) dan Syarat & Ketentuan (T&C).</p>
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

    <form action="{{ route('admin.tc.update') }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="space-y-6">
            <!-- Tentang Kami Section -->
            <div class="bg-white dark:bg-slate-800 p-6 md:p-8 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-6 flex items-center">
                    <span class="w-2 h-6 bg-blue-600 rounded-full mr-3"></span>
                    Tentang Kami
                </h3>
                
                <div>
                    <textarea id="about_us" name="about_us" rows="10"
                        class="block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition dark:text-white font-mono text-sm leading-relaxed" placeholder="Gunakan tag HTML untuk memformat paragraf, seperti <h2>, <p>, atau <ul>">{{ old('about_us', $about_us) }}</textarea>
                    <p class="mt-2 text-[10px] text-slate-500 dark:text-slate-400 font-medium">Informasi ini akan ditampilkan di halaman Tentang Kami. Mendukung format HTML <code>&lt;p&gt;</code>, <code>&lt;h2&gt;</code>, dll.</p>
                </div>
            </div>

            <!-- Syarat & Ketentuan Section -->
            <div class="bg-white dark:bg-slate-800 p-6 md:p-8 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-6 flex items-center">
                    <span class="w-2 h-6 bg-purple-600 rounded-full mr-3"></span>
                    Syarat & Ketentuan (T&C)
                </h3>
                
                <div>
                    <textarea id="terms_conditions" name="terms_conditions" rows="10"
                        class="block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition dark:text-white font-mono text-sm leading-relaxed" placeholder="Gunakan tag HTML untuk memformat paragraf, seperti <h2>, <p>, atau <ul>">{{ old('terms_conditions', $terms_conditions) }}</textarea>
                    <p class="mt-2 text-[10px] text-slate-500 dark:text-slate-400 font-medium">Informasi ini akan ditampilkan di halaman Syarat & Ketentuan. Mendukung format HTML <code>&lt;p&gt;</code>, <code>&lt;h2&gt;</code>, dll.</p>
                </div>
            </div>
            
            <div class="flex justify-end pt-4">
                <button type="submit" class="px-12 py-4 bg-slate-900 dark:bg-white text-white dark:text-slate-900 rounded-xl font-bold text-sm tracking-widest hover:bg-slate-800 dark:hover:bg-slate-100 transition shadow-xl shadow-slate-200 dark:shadow-none uppercase">
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
</x-admin-layout>
