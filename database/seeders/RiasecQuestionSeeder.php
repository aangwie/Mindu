<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\Option;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class RiasecQuestionSeeder extends Seeder
{
    public function run(): void
    {
        // Truncate tables to prevent duplicates
        Schema::disableForeignKeyConstraints();
        Question::truncate();
        Option::truncate();
        Schema::enableForeignKeyConstraints();

        $questions = [
            // R - Realistic (Focus: Prakarya, Alat, Alam, Olahraga) - 17 items
            ['text' => 'Saya suka memperbaiki alat-alat rumah tangga yang rusak seperti lampu atau sepeda.', 'cat' => 'R'],
            ['text' => 'Saya senang memasang tenda dan peralatan saat kegiatan berkemah pramuka.', 'cat' => 'R'],
            ['text' => 'Saya tertarik merawat tanaman atau berkebun di area sekolah.', 'cat' => 'R'],
            ['text' => 'Saya suka membuat kerajinan tangan dari kayu, bambu, atau logam.', 'cat' => 'R'],
            ['text' => 'Saya terbiasa menggunakan alat pertukangan seperti palu, obeng, atau kunci inggris.', 'cat' => 'R'],
            ['text' => 'Saya senang memelihara dan merawat hewan peliharaan dengan telaten.', 'cat' => 'R'],
            ['text' => 'Saya suka membersihkan dan merawat peralatan olahraga di sekolah.', 'cat' => 'R'],
            ['text' => 'Saya lebih suka beraktivitas di luar ruangan daripada di dalam ruangan.', 'cat' => 'R'],
            ['text' => 'Saya senang mengikuti kegiatan ekskul robotik atau elektronika dasar.', 'cat' => 'R'],
            ['text' => 'Saya menyukai pelajaran keterampilan atau prakarya yang banyak praktik tangan.', 'cat' => 'R'],
            ['text' => 'Saya ingin belajar cara kerja mesin sepeda motor atau mobil.', 'cat' => 'R'],
            ['text' => 'Saya suka memancing atau menjelajahi alam saat waktu libur.', 'cat' => 'R'],
            ['text' => 'Saya senang merakit model miniatur seperti pesawat, mobil, atau bangunan.', 'cat' => 'R'],
            ['text' => 'Saya suka olahraga yang menantang fisik seperti renang atau mendaki gunung.', 'cat' => 'R'],
            ['text' => 'Saya senang membantu membersihkan kolam ikan atau akuarium di rumah.', 'cat' => 'R'],
            ['text' => 'Saya suka membantu mengecat dinding atau pagar agar terlihat baru.', 'cat' => 'R'],
            ['text' => 'Saya senang menyusun barang-barang di gudang atau garasi agar rapi.', 'cat' => 'R'],

            // I - Investigative (Focus: Sains, Matematika, Penelitian, Logika) - 17 items
            ['text' => 'Saya senang membaca artikel tentang penemuan sains terbaru di internet.', 'cat' => 'I'],
            ['text' => 'Saya suka memecahkan teka-teki silang, Sudoku, atau soal logika lainnya.', 'cat' => 'I'],
            ['text' => 'Saya menikmati melakukan percobaan sederhana di laboratorium IPA sekolah.', 'cat' => 'I'],
            ['text' => 'Saya sering mencari tahu cara kerja suatu aplikasi atau software di internet.', 'cat' => 'I'],
            ['text' => 'Saya suka menganalisis penyebab suatu kejadian, misalnya mengapa banjir terjadi.', 'cat' => 'I'],
            ['text' => 'Saya merasa tertantang saat mengerjakan soal matematika yang sulit.', 'cat' => 'I'],
            ['text' => 'Saya senang membaca buku tentang sejarah dunia atau asal-usul manusia.', 'cat' => 'I'],
            ['text' => 'Saya selalu mencari fakta dan data yang akurat sebelum mengambil keputusan.', 'cat' => 'I'],
            ['text' => 'Saya tertarik mengikuti ekskul Karya Ilmiah Remaja (KIR).', 'cat' => 'I'],
            ['text' => 'Saya suka menghitung jarak dan waktu tempuh saat sedang bepergian.', 'cat' => 'I'],
            ['text' => 'Saya senang mengamati bintang atau fenomena langit di malam hari.', 'cat' => 'I'],
            ['text' => 'Saya suka mencari informasi tentang cara mengobati penyakit secara alami.', 'cat' => 'I'],
            ['text' => 'Saya senang menonton film dokumenter tentang kehidupan alam liar.', 'cat' => 'I'],
            ['text' => 'Saya menyukai game strategi yang membutuhkan pemikiran mendalam.', 'cat' => 'I'],
            ['text' => 'Saya tertarik mempelajari dasar-dasar bahasa pemrograman komputer.', 'cat' => 'I'],
            ['text' => 'Saya suka bertanya kepada guru IPA tentang teori kehidupan dan alam semesta.', 'cat' => 'I'],
            ['text' => 'Saya senang mengumpulkan benda-benda alam (daun/batuan) untuk diteliti.', 'cat' => 'I'],

            // A - Artistic (Focus: Seni, Desain, Musik, Kreativitas) - 17 items
            ['text' => 'Saya suka menggambar komik atau ilustrasi di buku catatan saya.', 'cat' => 'A'],
            ['text' => 'Saya senang menulis puisi, cerpen, atau mengisi buku harian.', 'cat' => 'A'],
            ['text' => 'Saya tertarik mempelajari alat musik baru seperti gitar, piano, atau biola.', 'cat' => 'A'],
            ['text' => 'Saya senang membuat desain poster atau sampul buku yang menarik.', 'cat' => 'A'],
            ['text' => 'Saya suka mengikuti lomba baca puisi atau pementasan drama di sekolah.', 'cat' => 'A'],
            ['text' => 'Saya senang memadupadankan warna pakaian agar terlihat modis.', 'cat' => 'A'],
            ['text' => 'Saya suka mencari ide-ide kreatif untuk mendekorasi kamar tidur saya.', 'cat' => 'A'],
            ['text' => 'Saya menikmati menonton pertunjukan teater, tari, atau konser musik.', 'cat' => 'A'],
            ['text' => 'Saya suka membuat video pendek kreatif untuk diunggah di media sosial.', 'cat' => 'A'],
            ['text' => 'Saya senang menari atau mengikuti kegiatan ekskul tari tradisional/modern.', 'cat' => 'A'],
            ['text' => 'Saya hobi mengambil foto pemandangan atau objek yang terlihat estetik.', 'cat' => 'A'],
            ['text' => 'Saya senang merancang kostum atau properti untuk acara perpisahan sekolah.', 'cat' => 'A'],
            ['text' => 'Saya suka mendengarkan musik untuk mencari inspirasi saat belajar.', 'cat' => 'A'],
            ['text' => 'Saya sering berimajinasi tentang dunia fantasi atau masa depan.', 'cat' => 'A'],
            ['text' => 'Saya suka membuat kerajinan dari tanah liat (gerabah) atau patung kecil.', 'cat' => 'A'],
            ['text' => 'Saya tertarik menulis lirik lagu atau mengubah aransemen musik sederhana.', 'cat' => 'A'],
            ['text' => 'Saya senang mengunjungi galeri seni atau museum kebudayaan.', 'cat' => 'A'],

            // S - Social (Focus: Menolong, Mengajar, Kerjasama, Organisasi) - 17 items
            ['text' => 'Saya merasa senang saat bisa membantu adik mengerjakan tugas sekolah.', 'cat' => 'S'],
            ['text' => 'Saya suka menjadi pendengar yang baik bagi teman yang sedang curhat.', 'cat' => 'S'],
            ['text' => 'Saya tertarik menjadi relawan dalam kegiatan bakti sosial di lingkungan rumah.', 'cat' => 'S'],
            ['text' => 'Saya senang menjelaskan materi pelajaran kepada teman yang belum paham.', 'cat' => 'S'],
            ['text' => 'Saya lebih suka bekerja dalam tim kelompok daripada bekerja sendirian.', 'cat' => 'S'],
            ['text' => 'Saya senang membantu mengatur acara ulang tahun teman atau keluarga.', 'cat' => 'S'],
            ['text' => 'Saya tertarik bergabung dengan organisasi PMR (Palang Merah Remaja).', 'cat' => 'S'],
            ['text' => 'Saya suka mengingatkan teman-teman untuk menjaga kerukunan di kelas.', 'cat' => 'S'],
            ['text' => 'Saya senang berkunjung ke panti asuhan atau tempat pelayanan sosial.', 'cat' => 'S'],
            ['text' => 'Saya suka memberikan saran yang memotivasi teman yang sedang bimbang.', 'cat' => 'S'],
            ['text' => 'Saya senang bertemu dengan orang-orang baru dan berkenalan.', 'cat' => 'S'],
            ['text' => 'Saya bersedia menjadi penengah jika ada teman yang sedang berselisih paham.', 'cat' => 'S'],
            ['text' => 'Saya senang memandu teman-teman dalam suatu permainan berkelompok.', 'cat' => 'S'],
            ['text' => 'Saya suka membantu orang tua menyambut tamu yang datang ke rumah.', 'cat' => 'S'],
            ['text' => 'Saya senang berdiskusi dalam kelompok untuk mencari solusi bersama.', 'cat' => 'S'],
            ['text' => 'Saya ingin menjadi bagian dari pengurus sekolah yang mengurusi kesejahteraan siswa.', 'cat' => 'S'],
            ['text' => 'Saya senang mengikuti kegiatan keagamaan bersama-sama di sekolah.', 'cat' => 'S'],

            // E - Enterprising (Focus: Kepemimpinan, Promosi, Bisnis, Publik) - 17 items
            ['text' => 'Saya suka berjualan makanan atau barang saat ada acara bazar di sekolah.', 'cat' => 'E'],
            ['text' => 'Saya berkeinginan menjadi ketua kelas atau pemimpin dalam kelompok belajar.', 'cat' => 'E'],
            ['text' => 'Saya berani berbicara atau melakukan presentasi di depan banyak orang.', 'cat' => 'E'],
            ['text' => 'Saya senang mengajak dan menggerakkan teman untuk memulai kegiatan baru.', 'cat' => 'E'],
            ['text' => 'Saya suka bernegosiasi untuk mendapatkan kesepakatan yang menguntungkan.', 'cat' => 'E'],
            ['text' => 'Saya senang merencanakan target nilai yang ingin saya capai tiap semester.', 'cat' => 'E'],
            ['text' => 'Saya suka menonton kisah sukses para pengusaha muda yang inspiratif.', 'cat' => 'E'],
            ['text' => 'Saya sering mencari ide untuk mendapatkan uang saku tambahan dengan berkarya.', 'cat' => 'E'],
            ['text' => 'Saya senang menjadi koordinator atau panitia dalam acara perpisahan sekolah.', 'cat' => 'E'],
            ['text' => 'Saya lihai meyakinkan orang tua agar mendapat izin mengikuti kegiatan tertentu.', 'cat' => 'E'],
            ['text' => 'Saya menyukai tantangan yang melibatkan kompetisi atau perlombaan antarsiswa.', 'cat' => 'E'],
            ['text' => 'Saya tertarik menjadi tim sukses dalam pemilihan ketua OSIS di sekolah.', 'cat' => 'E'],
            ['text' => 'Saya senang mengelola uang tabungan atau dana kas kelas dengan baik.', 'cat' => 'E'],
            ['text' => 'Saya suka membaca berita tentang perkembangan ekonomi atau bisnis terbaru.', 'cat' => 'E'],
            ['text' => 'Saya senang memberikan semangat kepada teman agar lebih rajin belajar.', 'cat' => 'E'],
            ['text' => 'Saya tertarik mencari peluang usaha kecil-kecilan saat libur panjang.', 'cat' => 'E'],
            ['text' => 'Saya suka mengatur jadwal harian agar semua tugas selesai tepat waktu.', 'cat' => 'E'],

            // C - Conventional (Focus: Kerapian, Data, Aturan, Detail) - 17 items
            ['text' => 'Saya senang merapikan buku-buku di rak sesuai dengan urutan yang benar.', 'cat' => 'C'],
            ['text' => 'Saya suka membuat daftar tugas harian yang sangat detail dan terorganisir.', 'cat' => 'C'],
            ['text' => 'Saya senang mengetik dokumen atau menginput data nilai ke dalam komputer.', 'cat' => 'C'],
            ['text' => 'Saya selalu mencatat pengeluaran uang saku saya dengan sangat teliti.', 'cat' => 'C'],
            ['text' => 'Saya suka menyimpan nota belanja atau dokumen penting dalam map khusus.', 'cat' => 'C'],
            ['text' => 'Saya menikmati kegiatan merakit mainan yang mengikuti petunjuk langkah demi langkah.', 'cat' => 'C'],
            ['text' => 'Saya sangat teliti dalam memeriksa kembali tugas agar tidak ada ejaan yang salah.', 'cat' => 'C'],
            ['text' => 'Saya suka pelajaran yang memiliki rumus pasti dan prosedur yang tetap.', 'cat' => 'C'],
            ['text' => 'Saya senang mengatur folder-folder di HP atau laptop agar mudah ditemukan.', 'cat' => 'C'],
            ['text' => 'Saya suka membantu orang tua mengarsipkan surat-surat penting keluarga.', 'cat' => 'C'],
            ['text' => 'Saya selalu berusaha mematuhi semua aturan sekolah dengan disiplin tinggi.', 'cat' => 'C'],
            ['text' => 'Saya merasa tenang jika bekerja di lingkungan yang rapi dan teratur.', 'cat' => 'C'],
            ['text' => 'Saya suka menyiapkan perlengkapan sekolah pada malam hari sebelum tidur.', 'cat' => 'C'],
            ['text' => 'Saya tertarik pada kegiatan yang melibatkan hitung-hitungan angka yang pasti.', 'cat' => 'C'],
            ['text' => 'Saya senang mendata stok peralatan ekskul agar tidak ada yang hilang.', 'cat' => 'C'],
            ['text' => 'Saya suka mempelajari tata bahasa dan aturan penulisan yang baku.', 'cat' => 'C'],
            ['text' => 'Saya bersedia menjadi bendahara kelas yang mencatat keuangan dengan jujur.', 'cat' => 'C'],
        ];

        $optionLabels = [
            ['text' => 'Sangat Tidak Setuju', 'point' => 1],
            ['text' => 'Tidak Setuju', 'point' => 2],
            ['text' => 'Ragu-ragu', 'point' => 3],
            ['text' => 'Setuju', 'point' => 4],
            ['text' => 'Sangat Setuju', 'point' => 5],
        ];

        foreach ($questions as $qData) {
            $question = Question::create([
                'question_text' => $qData['text'],
                'category' => $qData['cat'],
            ]);

            foreach ($optionLabels as $oData) {
                Option::create([
                    'question_id' => $question->id,
                    'option_text' => $oData['text'],
                    'point' => $oData['point'],
                ]);
            }
        }
    }
}
