<x-app-layout>
    <div class="min-h-[calc(100vh-160px)] flex items-center justify-center px-4 py-12">
        <div class="max-w-md w-full space-y-8 bg-white dark:bg-slate-800 p-8 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm text-center">
            <div class="mx-auto w-16 h-16 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center mb-6">
                <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </div>
            
            <div>
                <h2 class="text-3xl font-extrabold text-slate-900 dark:text-white mb-2">
                    Verifikasi Email Anda
                </h2>
                <p class="text-slate-600 dark:text-slate-400 mb-6">
                    Terima kasih telah mendaftar! Kami telah mengirimkan tautan aktivasi ke <strong>{{ $email }}</strong>. Silakan periksa kotak masuk (atau folder spam) Anda.
                </p>
            </div>

            @if (session('success'))
                <div class="mb-6 bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-400 px-4 py-3 rounded-xl flex items-center justify-center">
                    <p class="text-sm font-bold">{{ session('success') }}</p>
                </div>
            @endif

            @if (session('error') || $errors->any())
                <div class="mb-6 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-400 px-4 py-3 rounded-xl">
                    <p class="text-sm font-bold">{{ session('error') ?? $errors->first() }}</p>
                </div>
            @endif

            <form action="{{ route('verification.resend') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">
                
                <button type="submit"
                    class="w-full flex justify-center py-3 px-4 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 text-slate-900 dark:text-white text-sm font-bold rounded-lg transition duration-150">
                    Kirim Ulang Email Aktivasi
                </button>
            </form>

            <div class="pt-6 border-t border-slate-100 dark:border-slate-700 mt-6">
                <a href="{{ route('login') }}" class="text-sm font-bold text-blue-600 dark:text-blue-400 hover:text-blue-500">
                    Kembali ke Login
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
