<x-app-layout>
    <div class="max-w-3xl mx-auto px-4 py-8 md:py-12">
        <!-- Progress Bar -->
        <div class="mb-8">
            <div class="flex justify-between items-center mb-2">
                <span class="text-sm font-semibold text-blue-600 uppercase tracking-wider">Soal {{ $currentStep }} dari {{ $totalSteps }}</span>
                <span class="text-sm font-medium text-slate-500">{{ round(($currentStep / $totalSteps) * 100) }}% Selesai</span>
            </div>
            <div class="w-full bg-slate-200 rounded-full h-2">
                <div class="bg-blue-600 h-2 rounded-full transition-all duration-500 shadow-sm" style="width: {{ ($currentStep / $totalSteps) * 100 }}%"></div>
            </div>
        </div>

        <!-- Question Card -->
        <div class="bg-white p-6 md:p-10 rounded-2xl border border-slate-200 shadow-sm transition duration-300">
            <h3 class="text-xl md:text-2xl font-bold text-slate-900 leading-snug mb-8">
                {{ $question->question_text }}
            </h3>

            <form action="{{ route('test.submit') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    @foreach($question->options as $option)
                        <label class="group relative flex items-center p-4 border-2 border-slate-100 rounded-xl cursor-pointer hover:border-blue-100 hover:bg-blue-50/50 transition duration-150">
                            <input type="radio" name="option_id" value="{{ $option->id }}" required
                                class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-slate-300 transition duration-150">
                            <span class="ml-4 text-slate-700 font-medium group-hover:text-slate-900">{{ $option->option_text }}</span>
                            <div class="absolute inset-0 rounded-xl border-2 border-transparent group-has-[:checked]:border-blue-600 pointer-events-none transition duration-150"></div>
                        </label>
                    @endforeach
                </div>

                <div class="mt-10 flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center px-8 py-3 bg-blue-600 border border-transparent rounded-lg font-bold text-sm text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg shadow-blue-200">
                        {{ $currentStep == $totalSteps ? 'Kirim Jawaban' : 'Lanjut' }}
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                </div>
            </form>
        </div>

        <div class="mt-8 bg-blue-50 p-4 rounded-xl border border-blue-100 flex items-start space-x-3">
            <div class="shrink-0 text-blue-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <p class="text-xs text-blue-700 font-medium leading-relaxed">
                Pilih jawaban yang menurut Anda paling sesuai dengan minat diri sendiri. Tidak ada jawaban benar atau salah dalam tes ini.
            </p>
        </div>
    </div>
</x-app-layout>
