<x-student-layout>
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Left Column: Question Area -->
            <div class="flex-grow">
                <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden min-h-[500px] flex flex-col">
                    <div class="px-6 py-4 bg-slate-50 dark:bg-slate-900/50 border-b border-slate-200 dark:border-slate-700 flex justify-between items-center">
                        <div class="flex items-center space-x-3">
                            <span class="w-8 h-8 rounded-lg bg-blue-600 text-white flex items-center justify-center font-bold text-sm">
                                {{ $currentStep }}
                            </span>
                            <span class="text-sm font-bold text-slate-700 dark:text-slate-300">Pertanyaan Soal</span>
                        </div>
                        <div class="text-xs font-bold text-slate-400 uppercase tracking-widest">
                            Progress: {{ round((count($answers) / $totalSteps) * 100) }}%
                        </div>
                    </div>

                    <div class="p-8 flex-grow">
                        @if(session('error'))
                            <div class="mb-6 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-400 px-4 py-3 rounded-xl flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>
                                <p class="text-sm font-bold">{{ session('error') }}</p>
                            </div>
                        @endif

                        <h3 class="text-xl font-bold text-slate-800 dark:text-white leading-relaxed mb-8">
                            {{ $question->question_text }}
                        </h3>

                        <form id="testForm" action="{{ route('test.submit') }}" method="POST" class="space-y-4">
                            @csrf
                            @foreach($question->options as $option)
                                <label class="relative block group cursor-pointer">
                                    <input type="radio" name="option_id" value="{{ $option->id }}" 
                                        class="peer sr-only" {{ ($answers[$question->id] ?? null) == $option->id ? 'checked' : '' }}
                                        onchange="this.form.submit()">
                                    <div class="flex items-center p-5 bg-slate-50 dark:bg-slate-900/40 border-2 border-slate-100 dark:border-slate-700 rounded-2xl transition duration-150 peer-checked:border-blue-600 peer-checked:bg-blue-50 dark:peer-checked:bg-blue-900/20 group-hover:border-blue-200 dark:group-hover:border-slate-600">
                                        <div class="w-6 h-6 rounded-full border-2 border-slate-200 dark:border-slate-600 flex items-center justify-center peer-checked:border-blue-600 transition duration-150 mr-4">
                                            <div class="w-2.5 h-2.5 rounded-full bg-blue-600 scale-0 peer-checked:scale-100 transition duration-150"></div>
                                        </div>
                                        <span class="text-sm font-semibold text-slate-700 dark:text-slate-300 group-hover:text-slate-900 dark:group-hover:text-white transition duration-150">
                                            {{ $option->option_text }}
                                        </span>
                                    </div>
                                </label>
                            @endforeach

                            <div class="pt-10 flex justify-between items-center gap-4">
                                <div class="flex gap-4">
                                    @if($currentStep > 1)
                                        <a href="{{ route('tes', $currentStep - 1) }}" class="px-6 py-3 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 rounded-xl font-bold text-sm hover:bg-slate-200 dark:hover:bg-slate-600 transition">
                                            Sebelumnya
                                        </a>
                                    @endif
                                    @if($currentStep < $totalSteps)
                                        <a href="{{ route('tes', $currentStep + 1) }}" class="px-6 py-3 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 rounded-xl font-bold text-sm hover:bg-slate-200 dark:hover:bg-slate-600 transition">
                                            Selanjutnya
                                        </a>
                                    @endif
                                </div>

                                @if(count($answers) == $totalSteps)
                                    <button type="submit" name="finish" value="1" class="px-8 py-3 bg-emerald-600 text-white rounded-xl font-bold text-sm hover:bg-emerald-700 transition shadow-lg shadow-emerald-500/20 uppercase tracking-widest">
                                        Selesaikan Tes
                                    </button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Warning Reset -->
                <div class="mt-6 flex justify-center">
                    <form action="{{ route('test.reset') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengulang tes dari awal?')">
                        @csrf
                        <button type="submit" class="text-xs font-bold text-slate-400 hover:text-red-500 transition uppercase tracking-widest flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                            Ulangi Tes
                        </button>
                    </form>
                </div>
            </div>

            <!-- Right Column: Navigation Board -->
            <div class="w-full lg:w-72 shrink-0">
                <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm p-6 sticky top-24">
                    <h4 class="text-sm font-bold text-slate-900 dark:text-white uppercase tracking-wider mb-6 flex items-center">
                        <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        Daftar Soal
                    </h4>

                    <div class="grid grid-cols-5 gap-2">
                        @for($i = 1; $i <= $totalSteps; $i++)
                            @php
                                $qId = $randomIds ? $randomIds[$i-1] : \App\Models\Question::orderBy('id', 'asc')->skip($i-1)->value('id');
                                $isAnswered = isset($answers[$qId]);
                                $isCurrent = $currentStep == $i;
                            @endphp
                            <a href="{{ route('tes', $i) }}" 
                               class="w-full aspect-square flex items-center justify-center rounded-lg text-xs font-bold transition-all duration-200
                               {{ $isCurrent ? 'bg-blue-600 text-white shadow-md shadow-blue-500/30' : 
                                  ($isAnswered ? 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400' : 'bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-600') }}">
                                {{ $i }}
                            </a>
                        @endfor
                    </div>

                    <div class="mt-8 space-y-3 pt-6 border-t border-slate-100 dark:border-slate-700">
                        <div class="flex items-center text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            <div class="w-3 h-3 rounded bg-blue-600 mr-2"></div>
                            Sedang Dikerjakan
                        </div>
                        <div class="flex items-center text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            <div class="w-3 h-3 rounded bg-emerald-100 dark:bg-emerald-900/30 mr-2 border border-emerald-200 dark:border-emerald-800"></div>
                            Sudah Dijawab
                        </div>
                        <div class="flex items-center text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            <div class="w-3 h-3 rounded bg-slate-100 dark:bg-slate-700 mr-2 border border-slate-200 dark:border-slate-700"></div>
                            Belum Dijawab
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-student-layout>
