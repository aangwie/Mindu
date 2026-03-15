@extends('layouts.frontend')

@section('title', 'Kenali Potensi Diri Anda')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 text-white overflow-hidden relative">
    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
    <div class="absolute top-0 left-0 -ml-20 mt-20 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32 relative z-10">
        <div class="text-center max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black tracking-tight mb-6 leading-tight">
                Temukan <span class="text-blue-400">Potensi Asli</span> & Bangun Karir Ideal Anda
            </h1>
            <p class="text-lg md:text-xl text-blue-100 mb-10 leading-relaxed font-light">
                Ikuti tes psikologi berbasis teori Holland RIASEC untuk mengungkapkan minat, bakat, dan rekomendasi jurusan yang paling sesuai untuk kesuksesan masa depan Anda.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('register') }}" class="inline-flex justify-center items-center px-8 py-4 text-base font-bold rounded-full text-slate-900 bg-white hover:bg-blue-50 hover:text-blue-700 transition shadow-xl hover:-translate-y-1">
                    Mulai Tes Sekarang
                    <svg class="ml-2 -mr-1 w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                </a>
                <a href="#riasec-info" class="inline-flex justify-center items-center px-8 py-4 text-base font-bold rounded-full text-white bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/20 transition">
                    Pelajari Lebih Lanjut
                </a>
            </div>
        </div>
    </div>
</div>

<!-- RIASEC Info Section -->
<div id="riasec-info" class="py-20 bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-black text-slate-900 dark:text-white mb-4 tracking-tight">Apa itu Holland RIASEC?</h2>
            <div class="w-24 h-1 bg-blue-600 mx-auto rounded-full mb-6"></div>
            <p class="text-lg text-slate-600 dark:text-slate-400 max-w-3xl mx-auto">
                Teori Holland mengklasifikasikan orang ke dalam enam tipe kepribadian utama. Pemahaman terhadap tipe dominan Anda membantu memprediksi lingkungan kerja dan pendidikan yang akan membuat Anda paling produktif dan bahagia.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Realistic -->
            <div class="bg-slate-50 dark:bg-slate-800 rounded-2xl p-8 border border-slate-100 dark:border-slate-700 hover:shadow-xl hover:border-red-200 dark:hover:border-red-800 transition group">
                <div class="w-14 h-14 bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 rounded-xl flex items-center justify-center text-2xl font-black mb-6 group-hover:bg-red-600 group-hover:text-white transition">R</div>
                <h3 class="text-xl font-bold mb-3 text-slate-900 dark:text-white">Realistic <span class="text-sm font-normal text-slate-500 dark:text-slate-400">(Realistik)</span></h3>
                <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed mb-4">
                    Menyukai aktivitas fisik, praktis, dan benda nyata. Seringkali unggul dalam mekanik, atletik, atau bekerja dengan alam.
                </p>
            </div>

            <!-- Investigative -->
            <div class="bg-slate-50 dark:bg-slate-800 rounded-2xl p-8 border border-slate-100 dark:border-slate-700 hover:shadow-xl hover:border-blue-200 dark:hover:border-blue-800 transition group">
                <div class="w-14 h-14 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-xl flex items-center justify-center text-2xl font-black mb-6 group-hover:bg-blue-600 group-hover:text-white transition">I</div>
                <h3 class="text-xl font-bold mb-3 text-slate-900 dark:text-white">Investigative <span class="text-sm font-normal text-slate-500 dark:text-slate-400">(Investigatif)</span></h3>
                <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed mb-4">
                    Pemikir logis, analitis, dan sistematis. Senang memahami memecahkan masalah kompleks, meneliti, dan mempelajari hal baru.
                </p>
            </div>

            <!-- Artistic -->
            <div class="bg-slate-50 dark:bg-slate-800 rounded-2xl p-8 border border-slate-100 dark:border-slate-700 hover:shadow-xl hover:border-purple-200 dark:hover:border-purple-800 transition group">
                <div class="w-14 h-14 bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 rounded-xl flex items-center justify-center text-2xl font-black mb-6 group-hover:bg-purple-600 group-hover:text-white transition">A</div>
                <h3 class="text-xl font-bold mb-3 text-slate-900 dark:text-white">Artistic <span class="text-sm font-normal text-slate-500 dark:text-slate-400">(Artistik)</span></h3>
                <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed mb-4">
                    Kreatif, imajinatif, dan ekspresif. Menyukai lingkungan tanpa struktur kaku di mana mereka bisa mengekspresikan diri secara artistik.
                </p>
            </div>

            <!-- Social -->
            <div class="bg-slate-50 dark:bg-slate-800 rounded-2xl p-8 border border-slate-100 dark:border-slate-700 hover:shadow-xl hover:border-green-200 dark:hover:border-green-800 transition group">
                <div class="w-14 h-14 bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 rounded-xl flex items-center justify-center text-2xl font-black mb-6 group-hover:bg-green-600 group-hover:text-white transition">S</div>
                <h3 class="text-xl font-bold mb-3 text-slate-900 dark:text-white">Social <span class="text-sm font-normal text-slate-500 dark:text-slate-400">(Sosial)</span></h3>
                <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed mb-4">
                    Suka menolong, mengajar, dan berinteraksi. Empatik dan lebih suka bekerja sama dengan orang daripada bekerja dengan benda/data.
                </p>
            </div>

            <!-- Enterprising -->
            <div class="bg-slate-50 dark:bg-slate-800 rounded-2xl p-8 border border-slate-100 dark:border-slate-700 hover:shadow-xl hover:border-yellow-200 dark:hover:border-yellow-800 transition group">
                <div class="w-14 h-14 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400 rounded-xl flex items-center justify-center text-2xl font-black mb-6 group-hover:bg-yellow-600 group-hover:text-white transition">E</div>
                <h3 class="text-xl font-bold mb-3 text-slate-900 dark:text-white">Enterprising <span class="text-sm font-normal text-slate-500 dark:text-slate-400">(Wirausaha)</span></h3>
                <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed mb-4">
                    Ambisius, percaya diri, dan persuasif. Unggul dalam memimpin tim, mengambil peran manajerial, dan berorientasi pada pencapaian target.
                </p>
            </div>

            <!-- Conventional -->
            <div class="bg-slate-50 dark:bg-slate-800 rounded-2xl p-8 border border-slate-100 dark:border-slate-700 hover:shadow-xl hover:border-cyan-200 dark:hover:border-cyan-800 transition group">
                <div class="w-14 h-14 bg-cyan-100 dark:bg-cyan-900/30 text-cyan-600 dark:text-cyan-400 rounded-xl flex items-center justify-center text-2xl font-black mb-6 group-hover:bg-cyan-600 group-hover:text-white transition">C</div>
                <h3 class="text-xl font-bold mb-3 text-slate-900 dark:text-white">Conventional <span class="text-sm font-normal text-slate-500 dark:text-slate-400">(Konvensional)</span></h3>
                <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed mb-4">
                    Terorganisir, teliti, dan menyukai struktur. Ahli dalam menangani detail, data, prosedur yang pasti, dan tugas administratif.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="bg-blue-50 dark:bg-slate-800 py-20 border-t border-blue-100 dark:border-slate-700 transition-colors duration-300">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-black text-slate-900 dark:text-white mb-6 tracking-tight">Siap Memetakan Masa Depan Anda?</h2>
        <p class="text-lg text-slate-600 dark:text-slate-300 mb-8 max-w-2xl mx-auto">
            Bergabunglah dengan siswa lainnya yang telah menemukan jalur karir terbaik mereka. Pendaftaran gratis dan proses tes hanya memakan waktu 10-15 menit.
        </p>
        <a href="{{ route('register') }}" class="inline-flex justify-center items-center px-10 py-4 text-lg font-black rounded-full text-white bg-blue-600 hover:bg-blue-700 transition shadow-lg shadow-blue-600/30 dark:shadow-none hover:-translate-y-1">
            Daftar Sekarang
        </a>
    </div>
</div>
@endsection
