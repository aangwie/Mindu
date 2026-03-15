<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aboutUsContent = <<<'HTML'
<h2>Sejarah Kami</h2>
<p>Mindu didirikan pada tahun 2024 dengan visi untuk membantu para siswa, mahasiswa, dan para pencari kerja menemukan jalur karir terbaik yang sesuai dengan potensi sejati mereka. Kami percaya bahwa setiap individu memiliki bakat unik yang seringkali terpendam karena kurangnya informasi dan arahan yang tepat.</p>
<p>Dengan memanfaatkan instrumen tes psikologi yang telah teruji secara global, yaitu teori Holland RIASEC, Mindu hadir menjembatani kesenjangan antara minat pribadi dengan realitas dunia pendidikan dan profesional.</p>

<h2>Misi Kami</h2>
<ul>
    <li>Menyediakan sebuah platform asesmen psikologi yang mudah diakses, akurat, dan terpercaya bagi semua kalangan.</li>
    <li>Membantu sekolah dan institusi pendidikan dalam mengarahkan siswa-siswinya menuju jurusan dan fakultas yang paling sesuai.</li>
    <li>Memberikan wawasan dan pandangan baru tentang tren karir masa depan yang sejalan dengan profil kepribadian pengguna.</li>
</ul>

<h2>Tim Kami</h2>
<p>Sistem ini dirancang dan dikembangkan oleh tim ahli yang terdiri dari praktisi psikologi pendidikan, konselor karir berpengalaman, dan engineer teknologi informasi yang berdedikasi. Kami berkomitmen untuk terus berinovasi memberikan pelayanan terbaik untuk masa depan generasi penerus bangsa.</p>
HTML;

        $termsContent = <<<'HTML'
<h2>1. Ketentuan Umum</h2>
<p>Selamat datang di layanan psikotes online Mindu ("Layanan"). Dengan mengakses dan menggunakan Layanan ini, Anda menyatakan setuju untuk terikat dan mematuhi seluruh syarat dan ketentuan yang berlaku ("Syarat & Ketentuan"). Jika Anda tidak setuju, mohon untuk tidak menggunakan Layanan ini.</p>

<h2>2. Penggunaan Layanan</h2>
<p>Layanan ini ditujukan untuk memberikan rekomendasi jurusan dan referensi karir berdasarkan instrumen tes Holland RIASEC. Kami menekankan bahwa hasil dari tes ini bersifat <strong>sebagai panduan dan rekomendasi</strong>, dan tidak seharusnya dijadikan satu-satunya dasar dalam pengambilan keputusan hidup yang krusial.</p>
<ul>
    <li>Anda setuju untuk memberikan informasi data diri yang akurat, jujur, dan valid.</li>
    <li>Anda tidak diperkenankan menggunakan platform ini untuk tujuan ilegal, penipuan, atau perusakan sistem.</li>
    <li>Setiap akun pengguna adalah tanggung jawab penuh dari pengguna yang bersangkutan. Jaga kerahasiaan kata sandi Anda.</li>
</ul>

<h2>3. Hak Kekayaan Intelektual</h2>
<p>Seluruh konten, materi, algoritma tes, desain logo, dan elemen antarmuka yang terdapat dalam Layanan ini merupakan hak milik intelektual Mindu dan dilindungi oleh undang-undang hak cipta. Anda tidak diizinkan untuk menyalin, mereproduksi, mendistribusikan, atau membuat karya turunan darinya tanpa izin tertulis dari pihak Mindu.</p>

<h2>4. Privasi dan Data Pribadi</h2>
<p>Kami sangat menghargai privasi Anda. Segala bentuk data pribadi dan hasil tes akan disimpan secara rahasia di dalam database kami dan tidak akan diperjualbelikan kepada pihak ketiga manapun untuk tujuan komersial di luar layanan kami. Namun, kami berhak menggunakan data gabungan (anonim) untuk keperluan riset dan pengembangan instrumen tes ke depannya.</p>

<h2>5. Perubahan Syarat & Ketentuan</h2>
<p>Mindu berhak memodifikasi, menambah, atau menghapus bagian mana pun dari Syarat & Ketentuan ini kapan saja tanpa pemberitahuan sebelumnya. Penggunaan platform yang berkelanjutan setelah adanya perubahan akan dianggap sebagai persetujuan Anda terhadap perubahan tersebut.</p>

<p><em>Terakhir diperbarui: Maret 2026</em></p>
HTML;

        Setting::set('about_us', $aboutUsContent);
        Setting::set('terms_conditions', $termsContent);
    }
}
