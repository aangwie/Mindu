# Aktivasi Akun Mindu

Halo {{ $user->full_name }},

Terima kasih telah mendaftar di Mindu. Silakan klik tombol di bawah ini untuk mengaktifkan akun Anda agar dapat mulai mengerjakan tes.

<x-mail::button :url="url('/activate/' . $token)">
Aktifkan Akun
</x-mail::button>

Jika Anda tidak merasa mendaftar, silakan abaikan email ini.

Terima kasih,<br>
Tim {{ config('app.name') }}

