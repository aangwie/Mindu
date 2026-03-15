<x-admin-layout>
    <div class="mb-8">
        <a href="{{ route('admin.questions.index') }}" class="text-sm font-bold text-slate-500 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition uppercase tracking-widest flex items-center mb-2">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Kembali ke Daftar
        </a>
        <h2 class="text-3xl font-bold text-slate-900 dark:text-white">Tambah Soal Baru</h2>
        <p class="text-slate-600 dark:text-slate-400">Buat pertanyaan psikotest RIASEC baru beserta pilihan jawabannya.</p>
    </div>

    @if ($errors->any())
        <div class="mb-6 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-400 px-4 py-3 rounded-xl">
            <ul class="list-disc list-inside text-sm font-bold">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.questions.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Main Question Info -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white dark:bg-slate-800 p-6 md:p-8 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm">
                    <div class="space-y-6">
                        <div>
                            <label for="question_text" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Teks Pertanyaan</label>
                            <textarea id="question_text" name="question_text" rows="4" required
                                class="block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition dark:text-white">{{ old('question_text') }}</textarea>
                        </div>

                        <div>
                            <label for="category" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Kategori RIASEC</label>
                            <select id="category" name="category" required
                                class="block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition dark:text-white">
                                <option value="" disabled selected>Pilih Kategori</option>
                                @foreach(['R' => 'Realistic', 'I' => 'Investigative', 'A' => 'Artistic', 'S' => 'Social', 'E' => 'Enterprising', 'C' => 'Conventional'] as $key => $label)
                                    <option value="{{ $key }}" {{ old('category') == $key ? 'selected' : '' }}>{{ $key }} - {{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-4 mt-8">
                    <a href="{{ route('admin.questions.index') }}" class="px-8 py-3 bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-xl font-bold text-sm text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-600 transition">Batal</a>
                    <button type="submit" class="px-10 py-3 bg-blue-600 border border-transparent rounded-xl font-bold text-sm text-white uppercase tracking-widest hover:bg-blue-700 transition shadow-lg shadow-blue-500/20">Simpan Soal</button>
                </div>
            </div>

            <!-- Right Column: Options & Points -->
            <div class="space-y-6">
                <div class="bg-white dark:bg-slate-800 p-6 md:p-8 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-6 flex items-center">
                        <span class="w-2 h-6 bg-blue-600 rounded-full mr-3"></span>
                        Pilihan Jawaban
                    </h3>
                    
                    <div class="space-y-6">
                        @for($i = 0; $i < 5; $i++)
                        <div class="p-4 bg-slate-50 dark:bg-slate-900/50 rounded-xl border border-slate-200 dark:border-slate-700 relative">
                            <span class="absolute -top-3 left-4 px-2 py-0.5 bg-blue-600 text-[10px] font-bold text-white rounded-full uppercase">Pilihan {{ $i + 1 }}</span>
                            <div class="space-y-4 pt-2">
                                <div>
                                    <label class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase mb-1">Teks Jawaban</label>
                                    <input type="text" name="options[{{ $i }}][text]" required value="{{ old("options.{$i}.text") }}"
                                        class="block w-full px-3 py-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500 transition dark:text-white">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase mb-1">Poin (1-5)</label>
                                    <input type="number" name="options[{{ $i }}][point]" required min="1" max="5" value="{{ old("options.{$i}.point", $i + 1) }}"
                                        class="block w-full px-3 py-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500 transition dark:text-white">
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-admin-layout>
