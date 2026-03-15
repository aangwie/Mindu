<?php

namespace Database\Seeders;

use App\Models\Major;
use Illuminate\Database\Seeder;

class MajorSeeder extends Seeder
{
    public function run(): void
    {
        $majors = [
            // SMK Jurusan
            [
                'name' => 'Rekayasa Perangkat Lunak (RPL)',
                'level' => 'SMK',
                'dominant_riasec_code' => 'R,I',
                'description' => 'Jurusan yang berfokus pada pengembangan perangkat lunak, pemrograman, dan teknologi informasi. Cocok untuk siswa yang menyukai logika, pemecahan masalah teknis, dan dunia digital.',
            ],
            [
                'name' => 'Teknik Mesin',
                'level' => 'SMK',
                'dominant_riasec_code' => 'R,I',
                'description' => 'Jurusan yang mempelajari perancangan, pembuatan, dan pemeliharaan mesin. Ideal untuk siswa yang tertarik dengan alat, mesin, dan pekerjaan fisik yang membutuhkan analisis teknis.',
            ],
            [
                'name' => 'Teknik Komputer dan Jaringan (TKJ)',
                'level' => 'SMK',
                'dominant_riasec_code' => 'R,C',
                'description' => 'Jurusan yang mempelajari perakitan komputer, instalasi jaringan, dan administrasi server. Cocok untuk siswa yang menyukai pekerjaan teknis terstruktur dengan perangkat keras.',
            ],
            [
                'name' => 'Teknik Kendaraan Ringan (TKR)',
                'level' => 'SMK',
                'dominant_riasec_code' => 'R,E',
                'description' => 'Jurusan yang mempelajari perawatan dan perbaikan kendaraan bermotor. Ideal untuk siswa yang menyukai pekerjaan praktis, hands-on, dan berjiwa wirausaha.',
            ],
            [
                'name' => 'Desain Komunikasi Visual (DKV)',
                'level' => 'SMK',
                'dominant_riasec_code' => 'A,S',
                'description' => 'Jurusan yang berfokus pada desain grafis, multimedia, dan komunikasi visual. Cocok untuk siswa kreatif yang suka menggambar, mendesain, dan berkomunikasi melalui visual.',
            ],
            [
                'name' => 'Seni Rupa / Kriya',
                'level' => 'SMK',
                'dominant_riasec_code' => 'A,R',
                'description' => 'Jurusan yang mempelajari seni rupa dan kerajinan tangan. Ideal untuk siswa yang memiliki bakat seni tinggi dan menyukai pekerjaan kreatif dengan tangan.',
            ],
            [
                'name' => 'Akuntansi dan Keuangan Lembaga',
                'level' => 'SMK',
                'dominant_riasec_code' => 'C,E',
                'description' => 'Jurusan yang mempelajari pencatatan keuangan, perpajakan, dan administrasi bisnis. Cocok untuk siswa yang teliti, suka bekerja dengan angka, dan tertarik dunia bisnis.',
            ],
            [
                'name' => 'Manajemen Perkantoran',
                'level' => 'SMK',
                'dominant_riasec_code' => 'C,S',
                'description' => 'Jurusan yang mempelajari administrasi perkantoran, kesekretarisan, dan pengelolaan dokumen. Ideal untuk siswa yang terorganisir, komunikatif, dan suka bekerja dalam tim.',
            ],
            [
                'name' => 'Bisnis Daring dan Pemasaran',
                'level' => 'SMK',
                'dominant_riasec_code' => 'E,C',
                'description' => 'Jurusan yang mempelajari pemasaran digital, e-commerce, dan strategi bisnis online. Cocok untuk siswa yang berjiwa wirausaha dan suka berinovasi dalam dunia bisnis.',
            ],
            [
                'name' => 'Perhotelan dan Pariwisata',
                'level' => 'SMK',
                'dominant_riasec_code' => 'S,E',
                'description' => 'Jurusan yang mempelajari layanan perhotelan, pariwisata, dan hospitality. Ideal untuk siswa yang ramah, komunikatif, dan suka melayani orang lain.',
            ],
            [
                'name' => 'Keperawatan',
                'level' => 'SMK',
                'dominant_riasec_code' => 'S,I',
                'description' => 'Jurusan yang mempelajari dasar-dasar keperawatan dan kesehatan. Cocok untuk siswa yang peduli, sabar, dan tertarik dunia medis.',
            ],
            [
                'name' => 'Farmasi Industri',
                'level' => 'SMK',
                'dominant_riasec_code' => 'I,C',
                'description' => 'Jurusan yang mempelajari pembuatan dan pengelolaan obat-obatan. Ideal untuk siswa yang analitis, teliti, dan tertarik dengan ilmu farmasi.',
            ],

            // SMA Jurusan
            [
                'name' => 'IPA (Sains)',
                'level' => 'SMA',
                'dominant_riasec_code' => 'I,S',
                'description' => 'Jurusan yang berfokus pada sains dan matematika untuk persiapan kuliah di bidang kedokteran, teknik, sains murni, dan farmasi. Cocok untuk siswa yang analitis dan suka meneliti.',
            ],
            [
                'name' => 'IPA (Teknik)',
                'level' => 'SMA',
                'dominant_riasec_code' => 'I,R',
                'description' => 'Jurusan IPA dengan fokus persiapan ke fakultas teknik dan komputer. Ideal untuk siswa yang suka memecahkan masalah teknis dan berpikir logis.',
            ],
            [
                'name' => 'IPS (Sosial & Bisnis)',
                'level' => 'SMA',
                'dominant_riasec_code' => 'E,S',
                'description' => 'Jurusan yang mempelajari ekonomi, sosiologi, dan geografi untuk persiapan kuliah di bidang bisnis, hukum, dan ilmu sosial. Cocok untuk siswa yang suka berinteraksi dan memimpin.',
            ],
            [
                'name' => 'IPS (Humaniora)',
                'level' => 'SMA',
                'dominant_riasec_code' => 'S,A',
                'description' => 'Jurusan IPS dengan fokus humaniora untuk persiapan ke psikologi, pendidikan, atau pekerjaan sosial. Ideal untuk siswa empatik yang peduli dengan masyarakat.',
            ],
            [
                'name' => 'Bahasa dan Sastra',
                'level' => 'SMA',
                'dominant_riasec_code' => 'A,S',
                'description' => 'Jurusan yang berfokus pada bahasa asing, sastra, dan komunikasi. Cocok untuk siswa kreatif yang suka menulis, berkomunikasi, dan mempelajari budaya.',
            ],
            [
                'name' => 'Bahasa (Hubungan Internasional)',
                'level' => 'SMA',
                'dominant_riasec_code' => 'A,E',
                'description' => 'Jurusan bahasa dengan fokus komunikasi internasional dan diplomasi. Ideal untuk siswa yang berambisi, suka belajar bahasa, dan tertarik hubungan internasional.',
            ],
        ];

        foreach ($majors as $major) {
            Major::updateOrCreate(
                ['name' => $major['name']],
                $major
            );
        }
    }
}
