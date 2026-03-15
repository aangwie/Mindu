# Mindu — Sistem Psikotest Online (Holland RIASEC)

**Mindu** adalah aplikasi web psikotest berbasis teori **Holland RIASEC** yang dirancang untuk membantu siswa menemukan potensi minat dan bakat mereka. Sistem ini menghasilkan rekomendasi jurusan berdasarkan enam dimensi kepribadian: *Realistic, Investigative, Artistic, Social, Enterprising,* dan *Conventional*.

## ✨ Fitur Utama

| Fitur | Keterangan |
|---|---|
| **Tes RIASEC** | Sistem tes pilihan ganda dengan navigasi soal & progress tracker |
| **Dashboard Siswa** | Ringkasan profil, statistik tes, dan aksi cepat |
| **Riwayat Tes** | Tabel riwayat semua tes dengan skor per dimensi |
| **Unduh PDF** | Hasil tes dapat diunduh dalam format PDF |
| **Dashboard Admin** | Manajemen soal, pengguna, hasil tes, dan pengaturan |
| **Mode Gelap** | Mendukung tema Terang, Gelap, dan Otomatis (mengikuti sistem) |
| **Responsif** | Tampilan optimal di desktop, tablet, dan mobile |
| **Email Aktivasi** | Pendaftaran siswa memerlukan verifikasi email |
| **Reset Password** | Fitur lupa password via email |

## 🛠️ Teknologi

- **Backend:** Laravel 12, PHP 8.2+
- **Frontend:** Blade, Tailwind CSS v4, Alpine.js 3
- **Build Tool:** Vite 6
- **Database:** MySQL 5.7+ / MariaDB 10.3+
- **PDF:** DomPDF (via `barryvdh/laravel-dompdf`)
- **Server:** Apache (XAMPP) / Nginx

## 📋 Kebutuhan Sistem

| Komponen | Versi Minimum |
|---|---|
| PHP | 8.2 |
| Composer | 2.x |
| Node.js | 18.x |
| NPM | 9.x |
| MySQL / MariaDB | 5.7 / 10.3 |
| Ekstensi PHP | `gd`, `mbstring`, `openssl`, `pdo_mysql`, `intl`, `fileinfo` |

## 🚀 Instalasi

### 1. Clone Repository
```bash
git clone https://github.com/username/psikotest.git
cd psikotest
```

### 2. Install Dependensi
```bash
composer install
npm install
```

### 3. Konfigurasi Environment
```bash
cp .env.example .env
php artisan key:generate
```

Edit file `.env` dan sesuaikan pengaturan database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=psikotest
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=email@gmail.com
MAIL_PASSWORD=app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=email@gmail.com
MAIL_FROM_NAME="Mindu"
```

### 4. Migrasi & Seed Database
```bash
php artisan migrate --seed
```

### 5. Jalankan Aplikasi

> [!IMPORTANT]
> Sistem ini menggunakan **Tailwind CSS v4** dan **Vite 6**. Anda **WAJIB** menjalankan perintah berikut agar tampilan (CSS) dan fitur interaktif (seperti sidebar) berfungsi dengan normal.

Anda perlu menjalankan **dua terminal** secara bersamaan:

**Terminal 1 — Backend (PHP):**
```bash
php artisan serve
```

**Terminal 2 — Frontend (Vite/CSS):**
```bash
npm run dev
```

> [!TIP]
> Di **Dashboard Admin**, kami telah menambahkan **Indikator Status Vite**. Jika indikator berwarna merah, artinya Anda belum menjalankan `npm run dev` di Terminal 2.

Akses aplikasi di: [http://localhost:8000](http://localhost:8000)

### 6. Akun Default Admin
```
Email    : admin@admin.com
Password : password
```

## 📝 Ekstensi PHP (XAMPP)

Jika menggunakan **XAMPP**, pastikan ekstensi berikut aktif di `php.ini`:

1. Buka **XAMPP Control Panel** → klik **Config** di baris Apache → **PHP (php.ini)**
2. Cari dan hapus tanda `;` (titik koma) di depan baris berikut:
   ```ini
   extension=gd
   extension=intl
   extension=fileinfo
   ```
3. Simpan file dan **restart Apache**, lalu jalankan ulang `php artisan serve`.

## 📁 Struktur Project

```
psikotest/
├── app/
│   ├── Http/Controllers/    # Controller (Auth, Student, Admin)
│   ├── Models/              # Eloquent Models
│   ├── Services/            # Assessment Service (scoring logic)
│   └── View/Components/     # Blade Components
├── resources/
│   ├── views/
│   │   ├── layouts/         # Layout (admin, student, app)
│   │   ├── student/         # Student views (dashboard, test, history, profile)
│   │   ├── admin/           # Admin views
│   │   ├── auth/            # Login, Register, Reset Password
│   │   └── pdf/             # PDF template
│   ├── css/app.css          # Tailwind CSS entry
│   └── js/app.js            # JS entry
├── routes/web.php           # All route definitions
└── database/
    ├── migrations/          # Database schema
    └── seeders/             # Default data
```

## 📄 Lisensi

Proyek ini dikembangkan untuk keperluan edukasi.
