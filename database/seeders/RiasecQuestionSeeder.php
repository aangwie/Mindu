<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\Option;
use Illuminate\Database\Seeder;

class RiasecQuestionSeeder extends Seeder
{
    public function run(): void
    {
        $questions = [
            // R - Realistic
            ['text' => 'Saya suka memperbaiki alat-alat elektronik atau mesin.', 'cat' => 'R'],
            ['text' => 'Saya lebih suka bekerja dengan benda-benda nyata daripada ide-ide abstrak.', 'cat' => 'R'],
            ['text' => 'Saya tertarik mempelajari cara kerja mesin kendaraan.', 'cat' => 'R'],
            
            // I - Investigative
            ['text' => 'Saya senang memecahkan masalah matematika atau teka-teki logika.', 'cat' => 'I'],
            ['text' => 'Saya suka melakukan eksperimen atau penelitian ilmiah.', 'cat' => 'I'],
            ['text' => 'Saya sering bertanya-tanya mengapa sesuatu bekerja seperti itu di alam semesta.', 'cat' => 'I'],
            
            // A - Artistic
            ['text' => 'Saya suka menggambar, melukis, atau membuat desain visual.', 'cat' => 'A'],
            ['text' => 'Saya menikmati bermain alat musik atau menulis cerita kreatif.', 'cat' => 'A'],
            ['text' => 'Saya lebih suka lingkungan yang bebas mengekspresikan diri secara artistik.', 'cat' => 'A'],
            
            // S - Social
            ['text' => 'Saya merasa senang saat membantu orang lain memecahkan masalah mereka.', 'cat' => 'S'],
            ['text' => 'Saya suka mengajar atau menjelaskan sesuatu kepada teman-amannya.', 'cat' => 'S'],
            ['text' => 'Saya lebih suka bekerja dalam tim daripada bekerja sendirian.', 'cat' => 'S'],
            
            // E - Enterprising
            ['text' => 'Saya suka memimpin suatu kelompok atau organisasi.', 'cat' => 'E'],
            ['text' => 'Saya senang meyakinkan orang lain untuk mengikuti ide saya.', 'cat' => 'E'],
            ['text' => 'Saya tertarik untuk memulai bisnis atau usaha mandiri.', 'cat' => 'E'],
            
            // C - Conventional
            ['text' => 'Saya suka mengatur data atau file agar tertata rapi.', 'cat' => 'C'],
            ['text' => 'Saya lebih nyaman bekerja dengan instruksi dan prosedur yang jelas.', 'cat' => 'C'],
            ['text' => 'Saya teliti dalam memeriksa detail angka atau laporan.', 'cat' => 'C'],
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
