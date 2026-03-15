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
            // Realistic: 15 soal tentang mesin, alat, alam, atau kerja fisik
            ['text' => 'Saya senang merakit atau memperbaiki peralatan elektronik yang ada di rumah.', 'cat' => 'R'],
            ['text' => 'Saya suka melakukan pekerjaan bertukang seperti memaku, memotong kayu, atau mengecat.', 'cat' => 'R'],
            ['text' => 'Saya lebih suka beraktivitas fisik di luar ruangan daripada duduk lama di dalam ruangan.', 'cat' => 'R'],
            ['text' => 'Saya tertarik mempelajari cara kerja mesin, misalnya mesin motor, mobil, atau robotik.', 'cat' => 'R'],
            ['text' => 'Saya suka berkebun, memelihara tanaman, atau merawat taman sekolah.', 'cat' => 'R'],
            ['text' => 'Saya senang menggunakan alat-alat mekanik atau perkakas tangan sehari-hari.', 'cat' => 'R'],
            ['text' => 'Saya lebih tertarik pada benda-benda yang bisa diraba langsung (praktikal) dibanding teori.', 'cat' => 'R'],
            ['text' => 'Saya senang memelihara dan merawat hewan peliharaan secara langsung.', 'cat' => 'R'],
            ['text' => 'Saya suka membuat kerajinan dari bahan baku alam seperti bambu, logam, atau tanah liat.', 'cat' => 'R'],
            ['text' => 'Saya gemar merangkai komponen kecil, misalnya mainan model kit atau instalasi listrik dasar.', 'cat' => 'R'],
            ['text' => 'Saya senang melakukan pekerjaan fisik kasar yang menguras tenaga.', 'cat' => 'R'],
            ['text' => 'Saya suka menonton program acara televisi yang membahas kehidupan alam liar atau ekskavasi.', 'cat' => 'R'],
            ['text' => 'Saya ingin memiliki keterampilan teknis yang matang di bidang alat berat atau konstruksi.', 'cat' => 'R'],
            ['text' => 'Saya merasa nyaman bekerja atau menghabiskan waktu di bengkel/laboratorium kerja basah.', 'cat' => 'R'],
            ['text' => 'Saya suka mengemudikan kendaraan, menaiki alat berat, atau memancing di alam bebas.', 'cat' => 'R'],

            // Investigative: 15 soal tentang riset, matematika, dan pemecahan masalah
            ['text' => 'Saya sangat suka memecahkan soal matematika atau teka-teki logika yang rumit.', 'cat' => 'I'],
            ['text' => 'Saya menikmati membaca artikel, ensiklopedia, atau buku tentang penemuan ilmiah.', 'cat' => 'I'],
            ['text' => 'Saya senang melakukan percobaan sederhana di laboratorium laboratorium MIPA sekolah.', 'cat' => 'I'],
            ['text' => 'Saya suka menyelidiki dan menganalisis mengapa suatu fenomena alam bisa terjadi.', 'cat' => 'I'],
            ['text' => 'Saya selalu mencari fakta yang valid dan mendasar dari internet saat ada keraguan informasi.', 'cat' => 'I'],
            ['text' => 'Saya sangat menikmati pelajaran seperti biologi, fisika, atau kimia.', 'cat' => 'I'],
            ['text' => 'Saya tertarik untuk mendalami cara otak atau tubuh manusia bekerja secara medis.', 'cat' => 'I'],
            ['text' => 'Saya menyukai kegiatan diskusi sains atau ikut serta dalam Kelompok Ilmiah Remaja (KIR).', 'cat' => 'I'],
            ['text' => 'Saya senang mencari pola atau hubungan unik antar data yang saya kumpulkan.', 'cat' => 'I'],
            ['text' => 'Saya memiliki rasa ingin tahu yang sangat dalam soal fenomena antariksa atau luar angkasa.', 'cat' => 'I'],
            ['text' => 'Saya senang mengumpulkan sampel benda seperti batuan, daun, atau serangga untuk diteliti rinci.', 'cat' => 'I'],
            ['text' => 'Saya gemar memainkan game strategi atau puzzle yang memaksa saya berpikir sangat taktis.', 'cat' => 'I'],
            ['text' => 'Saya tertarik pada profesi peneliti laboratorium, ilmuwan, atau menjadi orang di bidang kedokteran.', 'cat' => 'I'],
            ['text' => 'Saya kerap merenungkan atau mendiskusikan pertanyaan-pertanyaan berat seputar alam semesta.', 'cat' => 'I'],
            ['text' => 'Saya senang menganalisis kesalahan berulang untuk menemukan perumusan penyelesaian yang tepat.', 'cat' => 'I'],

            // Artistic: 15 soal tentang seni, musik, desain, dan kreativitas
            ['text' => 'Saya suka menuangkan ide lewat lukisan, coretan, atau menggambar ilustrasi digital.', 'cat' => 'A'],
            ['text' => 'Saya senang menulis cerita imajinatif, esai kreatif, cerpen, atau puisi.', 'cat' => 'A'],
            ['text' => 'Saya hobi berlama-lama mendengarkan musik untuk mencari inspirasi berkarya.', 'cat' => 'A'],
            ['text' => 'Saya tertarik untuk belajar dan menguasai main alat instrumen musik seperti gitar/piano/dll.', 'cat' => 'A'],
            ['text' => 'Saya suka merancang desain mode pakaian, aksesori jepit tangan, atau mendekor kamar saya.', 'cat' => 'A'],
            ['text' => 'Saya sangat tertarik dengan desain grafis, fotografi, atau pembuatan film estetik.', 'cat' => 'A'],
            ['text' => 'Saya sangat antusias jika harus tampil melenturkan badan (menari) atau menyanyi untuk madding/tontonan.', 'cat' => 'A'],
            ['text' => 'Saya senang berekspresi secara bebas melalui kelompok pementasan teater atau drama sekolah.', 'cat' => 'A'],
            ['text' => 'Saya merasa imajinasi saya sangat cepat bergerak dan berlimpah ide pada ide-ide non formal.', 'cat' => 'A'],
            ['text' => 'Saya suka bereksperimen mengkolaborasikan dan mencari paduan warna yang indah.', 'cat' => 'A'],
            ['text' => 'Saya menggemari melihat pameran-pameran unik, museum kesenian, atau galeri kebudayaan modern.', 'cat' => 'A'],
            ['text' => 'Saya lebih berprestasi dan semangat ketika diberi kebebasan bereksperimen desain tanpa batas aturan riil.', 'cat' => 'A'],
            ['text' => 'Saya sangat menikmati aktivitas daur ulang sampah kertas menjadi karya seni estetik/ornamen unik.', 'cat' => 'A'],
            ['text' => 'Saya ingin dan berusaha untuk bisa mengaransemen atau mencipta karya orisinal berupa melodi/lagu sendiri.', 'cat' => 'A'],
            ['text' => 'Saya menemukan kenyamanan psikologis setiap melakukan aktivitas kreasi seni tangan/abstrak.', 'cat' => 'A'],

            // Social: 15 soal tentang mengajar, merawat, dan membantu orang
            ['text' => 'Saya bersedia dengan sabar menjelaskan ulang pelajaran kepada teman yang kesulitan menyerap materi.', 'cat' => 'S'],
            ['text' => 'Saya suka menemani teman bicara, menjadi pendengar curhat yang nyaman, dan memberi nasihat sosial positif.', 'cat' => 'S'],
            ['text' => 'Saya tertarik ambil bagian saat ada aksi turun kelas ke panti asuhan, kerja bakti, atau bakti sosial kemanusiaan.', 'cat' => 'S'],
            ['text' => 'Saya sangat mudah merasa welas asih dan berempati tinggi jika melihat orang lain hidup sengsara/kesusahan.', 'cat' => 'S'],
            ['text' => 'Saya senang berkumpul, bergaul, berorganisasi murni pengabdian di lingkungan sekitar, misal organisasi kepemudaan.', 'cat' => 'S'],
            ['text' => 'Saya bercita-cita berkarir sebagai guru teladan, perawat medik, pembimbing psikologis, atau aktivis desa.', 'cat' => 'S'],
            ['text' => 'Saya jauh lebih menikmati bekerja dan belajar dalam tim secara komunal dibandingkan bekerja egosentris menyendiri.', 'cat' => 'S'],
            ['text' => 'Saya menyukai berada bersama kelompok kepanitiaan penyambutan warga sekolah (Misal: Panitia MOS/OSPEK).', 'cat' => 'S'],
            ['text' => 'Saya sering mengambil tanggung jawab sebagai penengah yang melerai teman jika ada dua pihak yang sedang berkelahi.', 'cat' => 'S'],
            ['text' => 'Saya senang mengekspansi pergaulan baru dengan berkenalan dengan sembarang kelompok orang tanpa gengsi.', 'cat' => 'S'],
            ['text' => 'Saya suka dengan inisiatif menyambut junior atau warga ekstrakurikuler baru agar mereka lekas gembira gabung kelompik ini.', 'cat' => 'S'],
            ['text' => 'Saya sering mengingatkan kawan sebaya perihal kesehatan fisik maupun rohaninya.', 'cat' => 'S'],
            ['text' => 'Saya gemar mengambil porsi seksi kesejahteraan anggota saat panitia (menyediakan obat P3k dan asupan vitamin relawan kelompok).', 'cat' => 'S'],
            ['text' => 'Saya mempercayai sepenuh jiwa prinsip gotong royong memikul bersama beban anggota teman kelompok sejati.', 'cat' => 'S'],
            ['text' => 'Saya suka bekerja pada ruang pelayanan publik melayani orang yang sedang antri minta panduan/fasilitas.', 'cat' => 'S'],

            // Enterprising: 15 soal tentang memimpin, jualan, dan persuasi
            ['text' => 'Saya suka sekali praktik keahlian jual-beli (menjajakan dagangan) saat hari wirausaha sekolah/Bazar Market Day.', 'cat' => 'E'],
            ['text' => 'Saya mencalonkan diri terdepan saat ajang pemilihan OSIS/pendaftaran menjadi pemimpin kelompok.', 'cat' => 'E'],
            ['text' => 'Saya sangat gemar dan suka memunculkan kemampuan public speaking (pidato) meyakinkan pendengar di mimbar orasi.', 'cat' => 'E'],
            ['text' => 'Saya terus tertantang menyisir laba lewat berjualan, memahami dinamika untung rugi dari praktik makelar.', 'cat' => 'E'],
            ['text' => 'Saya merasa percaya diri berdebat frontal mempertahankan opini demi mempengaruhi pemikiran lawan bicara agar sepakat.', 'cat' => 'E'],
            ['text' => 'Saya suka menjadi pengatur taktik komando eksekutor pergerakan supaya ambisi memenangi perlombaan tercapai semua regu.', 'cat' => 'E'],
            ['text' => 'Saya benci menjadi medioker, saya punya nafsu ingin merajai/memenangkan persaingan keras antar kontingen kelompok piala.', 'cat' => 'E'],
            ['text' => 'Saya sering melontarkan seruan komando membakar mental teman satu regu agar selalu "Tancap Gas" dan ngotot menang di lapangan.', 'cat' => 'E'],
            ['text' => 'Saya bukan orang penakut soal resiko yang memicu peluang uang atau pergerakan yang bisa meraih pamor tenar tinggi (Risk Taker).', 'cat' => 'E'],
            ['text' => 'Saya tidak sedikit pun takut mental ketika saya diterjunkan me-lobby sponsor komersil mencari donor pemasukan uang program panitia acara.', 'cat' => 'E'],
            ['text' => 'Saya terdorong mengeksplor karakter visioner sukses ala para top manager corporate/konglomerat pengusaha nasional yang tenar.', 'cat' => 'E'],
            ['text' => 'Saya menyenangi pergaulan ke golongan pejabat mapan karena relasi luas adalah hal terpenting.', 'cat' => 'E'],
            ['text' => 'Saya rajin bertekad bulat mencari target pengumpulan sumbangan modal dana demi meluncurkan event organisasi ekstra sekolah saya.', 'cat' => 'E'],
            ['text' => 'Saya merasa sangat ahli memimpin majelis perbincangan/memimpin rapat sidang agar jalannya instruksi satu komando dari saya bulat mulus dan sah disetujui.', 'cat' => 'E'],
            ['text' => 'Saya acapkali mendominasi menyetir teman sebaya di kala keraguan masif melanda dalam kepanitiaan; mereka selalu merujuk saya menjadi penentu ketok palu final.', 'cat' => 'E'],

            // Conventional: 15 soal tentang data, administrasi, dan keteraturan
            ['text' => 'Saya sangat lega saat merapikan urutan kronologi arsip tumpukan kertas berserakan dimasukan ke rak indeks agar memusatkan kerapian sentral.', 'cat' => 'C'],
            ['text' => 'Saya sangat jeli dan berlebihan dalam meneliti berulangkali teks untuk revisi titik koma serta membenarkan tanda baca dan cetak tebal sebuah laporan.', 'cat' => 'C'],
            ['text' => 'Saya adalah pengabdi pencatatan To-Do List tabel jadwal yang sangat detail di mana saya sangat taat memenuhi semua centang rutinitas ketat itu harian produktif.', 'cat' => 'C'],
            ['text' => 'Saya mengutuk kejutan improvisasi tugas; saya fans fanatik bekerja secara runtut bertahap step-by-step per plan terencana secara prosedural kaku/SOP mengikat absolut.', 'cat' => 'C'],
            ['text' => 'Saya menjunjung tinggi pendisiplinan jam sekolah wajib tepat menit, pakai baju identik tata tertib, tak peduli alasan teknis wajib taat absolut pada aturan sentral birokrasinya.', 'cat' => 'C'],
            ['text' => 'Saya menyukai urusan mengadministrasikan inventaris gudang logistik ekskul, angka nominal per unit barang jelas, pengeluaran debet-kredit di kolom rekapitulasi masuk kalkulator akurat presisi.', 'cat' => 'C'],
            ['text' => 'Saya pantang menghabisi selisih minus, catat saku pembukuan pengeluaran receh di dompet finansial buku kas ku dicatat rinci kaku rapi persis bon belanjaannya tak meleset Rp 1 pun laporannya rapi.', 'cat' => 'C'],
            ['text' => 'Saya telaten mengolah tumpuk input lembaran blanko ratusan baris sel kuesioner kotor yang di transformasi ke entri tabel format software form Excel kaku secara serentak ribuan kolom entry data.', 'cat' => 'C'],
            ['text' => 'Saya lebih gemar dikondisikan pada bangku staf sekretaris notulis pembina notulen ketik, mencatatkan absensi harian formal para hadirin, rekap rapi masuk kotak surat file pengarsipan panitia rapat perihal formal presensi lengkap.', 'cat' => 'C'],
            ['text' => 'Saya benci ke acakan atau ritme amburadul acak mendadak jadwal dadakan, sebab saya mendewakan ritme tenang ritmis tetap, pola rutinitas hari formal sama persis berulang harian tak banyak ubahan mengejutkan.', 'cat' => 'C'],
            ['text' => 'Saya menuntun obsesi ruang yang sangat sangat harus bersih letak persisnya per milimeter tatanannya terorganisir statis presisi, alat porselin simetris fungsinya serapi perpustakaan baku.', 'cat' => 'C'],
            ['text' => 'Saya sangat jeli mengabdi rajin cek teliti pada akurasi kalkuklasi ulangan re-validasi hasil hitungan matematika di meja pengerjaan soal ujian akuntansi/neraca per data agar kevalidan 100% tepat total absolut nihil silap hitung.', 'cat' => 'C'],
            ['text' => 'Saya gandrung minat mengurus tata arsip kepustakaan formal label baris barcode, birokrasi penyusunan nota stempel sah biro surat resmi stempel di kelurahan / instansi pemerintahan administrasi tertulis persis format protokoler.', 'cat' => 'C'],
            ['text' => 'Saya benci bekerja dari prediksi mistis / asbun coba-coba insting yang menduga-duga, yang saya tuntut porsi bekerja hanya mengikuti rel prosedur manual text book pakem pasti yang jukir baku secara hierarkis.', 'cat' => 'C'],
            ['text' => 'Saya memporsikan jadwalan khusus untuk periodik rekap ulang sinkronasi bersih laci berkas rak, hapus arsip debu cache trash per komputer, dan validasi defragmentasi penataan folder statis terkotak blok data kronologis presisi reguler tiap termin.', 'cat' => 'C'],
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
