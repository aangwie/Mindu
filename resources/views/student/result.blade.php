<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-12">
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
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
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <!-- Scores Chart (Simple Representation) -->
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center">
                            <span class="w-2 h-6 bg-blue-600 rounded-full mr-3"></span>
                            Skor RIASEC Anda
                        </h3>
                        <div class="space-y-4">
                            @foreach([
                                'R' => ['Realistic', $result->score_r, 'bg-red-500 shadow-red-200'],
                                'I' => ['Investigative', $result->score_i, 'bg-blue-500 shadow-blue-200'],
                                'A' => ['Artistic', $result->score_a, 'bg-purple-500 shadow-purple-200'],
                                'S' => ['Social', $result->score_s, 'bg-green-500 shadow-green-200'],
                                'E' => ['Enterprising', $result->score_e, 'bg-yellow-500 shadow-yellow-200'],
                                'C' => ['Conventional', $result->score_c, 'bg-slate-500 shadow-slate-200'],
                            ] as $key => $data)
                            <div>
                                <div class="flex justify-between text-sm font-semibold mb-1">
                                    <span class="text-slate-700">{{ $data[0] }} ({{ $key }})</span>
                                    <span class="text-slate-900">{{ $data[1] }}</span>
                                </div>
                                <div class="w-full bg-slate-100 rounded-full h-3">
                                    <div class="{{ $data[2] }} h-3 rounded-full shadow-lg transition-all duration-1000 ease-out" style="width: {{ min(100, ($data[1]/20)*100) }}%"></div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Recommendation Card -->
                    <div class="flex flex-col">
                        <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center">
                            <span class="w-2 h-6 bg-indigo-600 rounded-full mr-3"></span>
                            Rekomendasi Penjurusan
                        </h3>
                        <div class="flex-grow bg-slate-50 border border-slate-200 p-8 rounded-2xl flex flex-col justify-center items-center text-center relative overflow-hidden group">
                            <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity"></div>
                            
                            <div class="mb-4 p-4 bg-indigo-100 text-indigo-700 rounded-2xl">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                            
                            <h4 class="text-sm font-bold text-indigo-600 uppercase tracking-widest mb-1">Anda disarankan masuk</h4>
                            <div class="text-5xl font-black text-slate-900 mb-4">{{ $result->recommendation }}</div>
                            <p class="text-sm text-slate-600 leading-relaxed max-w-xs mx-auto">
                                {{ $result->final_reasoning }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Action Button -->
                <div class="mt-12 flex flex-col sm:flex-row justify-center items-center gap-4">
                    <a href="{{ route('download-result', $result->id) }}" 
                        class="w-full sm:w-auto inline-flex items-center justify-center px-10 py-4 bg-slate-900 text-white rounded-xl font-bold text-sm tracking-widest hover:bg-slate-800 transition shadow-xl shadow-slate-200 group">
                        <svg class="w-5 h-5 mr-3 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        UNDUH HASIL (.PDF)
                    </a>
                </div>
            </div>
        </div>
        
        <div class="mt-8 text-center">
            <a href="/" class="text-sm font-bold text-slate-500 hover:text-blue-600 transition uppercase tracking-widest">
                &larr; Kembali Beranda
            </a>
        </div>
    </div>
</x-app-layout>
