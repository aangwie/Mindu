<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-12">
        <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
            <!-- Header Section -->
            <div class="bg-gradient-to-br from-blue-600 to-indigo-700 px-8 py-10 text-white relative overflow-hidden">
                <div class="relative z-10">
                    <h2 class="text-3xl font-extrabold mb-2 uppercase tracking-tight">Hasil Rekomendasi Karir</h2>
                    <p class="text-blue-100 font-medium">Berdasarkan minat dan preferensi yang Anda berikan</p>
                </div>
                <div class="absolute -right-12 -top-12 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute -left-12 -bottom-12 w-64 h-64 bg-white/5 rounded-full blur-2xl"></div>
            </div>

            <!-- Content Section -->
            <div class="p-8 md:p-12">
                <!-- RIASEC Scores -->
                <div class="mb-10">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-6 flex items-center">
                        <span class="w-2 h-6 bg-blue-600 rounded-full mr-3"></span>
                        Skor RIASEC Anda
                    </h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach([
                            'R' => ['Realistic', $result->score_r, 'from-red-500 to-red-600', 'bg-red-50 dark:bg-red-900/20'],
                            'I' => ['Investigative', $result->score_i, 'from-blue-500 to-blue-600', 'bg-blue-50 dark:bg-blue-900/20'],
                            'A' => ['Artistic', $result->score_a, 'from-purple-500 to-purple-600', 'bg-purple-50 dark:bg-purple-900/20'],
                            'S' => ['Social', $result->score_s, 'from-green-500 to-green-600', 'bg-green-50 dark:bg-green-900/20'],
                            'E' => ['Enterprising', $result->score_e, 'from-yellow-500 to-yellow-600', 'bg-yellow-50 dark:bg-yellow-900/20'],
                            'C' => ['Conventional', $result->score_c, 'from-slate-500 to-slate-600', 'bg-slate-50 dark:bg-slate-700/30'],
                        ] as $key => $data)
                        <div class="p-4 rounded-xl {{ $data[3] }} border border-slate-100 dark:border-slate-700">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase">{{ $key }}</span>
                                <span class="text-lg font-black text-slate-900 dark:text-white">{{ $data[1] }}</span>
                            </div>
                            <p class="text-sm font-medium text-slate-700 dark:text-slate-300">{{ $data[0] }}</p>
                            <div class="w-full bg-slate-200 dark:bg-slate-600 rounded-full h-2 mt-2">
                                <div class="bg-gradient-to-r {{ $data[2] }} h-2 rounded-full transition-all duration-1000 ease-out" style="width: {{ min(100, ($data[1]/25)*100) }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Top Recommendation -->
                <div class="mb-10">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-6 flex items-center">
                        <span class="w-2 h-6 bg-indigo-600 rounded-full mr-3"></span>
                        Rekomendasi Utama
                    </h3>
                    <div class="bg-gradient-to-br from-indigo-50 to-blue-50 dark:from-indigo-900/20 dark:to-blue-900/20 border border-indigo-100 dark:border-indigo-800 p-8 rounded-2xl text-center">
                        <h4 class="text-sm font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest mb-2">Anda disarankan masuk</h4>
                        <div class="text-3xl md:text-4xl font-black text-slate-900 dark:text-white mb-2">{{ $result->recommendation }}</div>
                        @if(!empty($recommendationDetails) && count($recommendationDetails) > 0)
                        <div class="text-xl md:text-2xl font-bold text-indigo-700 dark:text-indigo-300 mb-6">
                            Jurusan: {{ $recommendationDetails[0]['major'] }}
                        </div>
                        @endif
                        <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed max-w-lg mx-auto">
                            {{ $result->final_reasoning }}
                        </p>
                    </div>
                </div>

                <!-- 3 Recommended Majors -->
                @if(!empty($recommendationDetails))
                <div class="mb-10">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-6 flex items-center">
                        <span class="w-2 h-6 bg-emerald-600 rounded-full mr-3"></span>
                        3 Jurusan Terbaik untuk Anda
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach($recommendationDetails as $detail)
                        @php
                            $rankColors = [
                                1 => ['border-yellow-400 dark:border-yellow-500', 'bg-yellow-50 dark:bg-yellow-900/20', 'text-yellow-600 dark:text-yellow-400', '🥇'],
                                2 => ['border-slate-300 dark:border-slate-500', 'bg-slate-50 dark:bg-slate-700/30', 'text-slate-500 dark:text-slate-400', '🥈'],
                                3 => ['border-amber-300 dark:border-amber-600', 'bg-amber-50 dark:bg-amber-900/20', 'text-amber-600 dark:text-amber-400', '🥉'],
                            ];
                            $colors = $rankColors[$detail['rank']] ?? $rankColors[3];
                        @endphp
                        <div class="rounded-2xl border-2 {{ $colors[0] }} {{ $colors[1] }} p-6 flex flex-col">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-2xl">{{ $colors[3] }}</span>
                                <span class="text-[10px] font-bold px-2 py-1 rounded-full {{ $detail['level'] === 'SMK' ? 'bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400' : 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400' }}">{{ $detail['level'] }}</span>
                            </div>
                            <h4 class="font-bold text-slate-900 dark:text-white text-sm mb-2">{{ $detail['major'] }}</h4>
                            <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed flex-grow">{{ $detail['description'] }}</p>
                            <div class="mt-3 pt-3 border-t border-slate-200 dark:border-slate-600">
                                <div class="flex items-center justify-between">
                                    <span class="text-[10px] font-bold text-slate-400 uppercase">Kecocokan</span>
                                    <span class="text-sm font-black {{ $colors[2] }}">{{ $detail['match_score'] }} poin</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Action Button -->
                <div class="mt-8 flex flex-col sm:flex-row justify-center items-center gap-4">
                    <a href="{{ route('download-result', $result->id) }}" 
                        class="w-full sm:w-auto inline-flex items-center justify-center px-10 py-4 bg-slate-900 dark:bg-white text-white dark:text-slate-900 rounded-xl font-bold text-sm tracking-widest hover:bg-slate-800 dark:hover:bg-slate-100 transition shadow-xl group">
                        <svg class="w-5 h-5 mr-3 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        UNDUH HASIL (.PDF)
                    </a>
                    <a href="{{ route('student.history') }}" 
                        class="w-full sm:w-auto inline-flex items-center justify-center px-10 py-4 bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-slate-600 rounded-xl font-bold text-sm tracking-widest hover:bg-slate-50 dark:hover:bg-slate-600 transition">
                        Riwayat Tes
                    </a>
                </div>
            </div>
        </div>
        
        <div class="mt-8 text-center">
            <a href="{{ route('student.dashboard') }}" class="text-sm font-bold text-slate-500 dark:text-slate-400 hover:text-blue-600 transition uppercase tracking-widest">
                &larr; Kembali ke Dashboard
            </a>
        </div>
    </div>
</x-app-layout>
