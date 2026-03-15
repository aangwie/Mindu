@extends('layouts.frontend')

@section('title', 'Tentang Kami')

@section('content')
<!-- Header -->
<div class="bg-slate-900 text-white py-16 md:py-24">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-black tracking-tight mb-4">Tentang Kami</h1>
        <p class="text-lg text-slate-400 max-w-2xl mx-auto font-light">Mengenal lebih dekat {{ config('app.name', 'Mindu') }} dan dedikasi kami untuk masa depan.</p>
    </div>
</div>

<!-- Content -->
<div class="bg-white dark:bg-slate-900 py-16 md:py-24 transition-colors duration-300 min-h-[50vh]">
    <div class="max-w-3xl mx-auto px-4 sm:px-6">
        <div class="prose prose-lg prose-slate dark:prose-invert max-w-none">
            {!! $about_us !!}
        </div>
        
        @if(empty(trim($about_us)) || $about_us == 'Informasi Tentang Kami belum tersedia.')
            <div class="text-center bg-slate-50 dark:bg-slate-800 p-10 rounded-2xl border border-slate-100 dark:border-slate-700">
                <svg class="w-16 h-16 text-slate-300 dark:text-slate-600 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <h3 class="text-xl font-bold text-slate-700 dark:text-slate-300 mb-2">Informasi Belum Tersedia</h3>
                <p class="text-slate-500 dark:text-slate-400">Halaman ini sedang dalam pembaruan oleh administrator.</p>
            </div>
        @endif
    </div>
</div>
@endsection
