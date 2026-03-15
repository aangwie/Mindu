<?php

namespace App\Services;

use App\Models\Major;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Support\Collection;

class AssessmentService
{
    /**
     * Calculate scores for each RIASEC category.
     * $answers is an array of [question_id => option_id]
     */
    public function calculateScores(array $answers): array
    {
        $scores = [
            'R' => 0,
            'I' => 0,
            'A' => 0,
            'S' => 0,
            'E' => 0,
            'C' => 0,
        ];

        foreach ($answers as $questionId => $optionId) {
            $option = Option::find($optionId);
            $question = Question::find($questionId);

            if ($option && $question) {
                $scores[$question->category] += $option->point;
            }
        }

        return $scores;
    }

    /**
     * Determine recommendation based on RIASEC scores.
     * Returns top recommendation + 3 best matching majors.
     */
    public function getRecommendation(array $scores, ?string $userInterest): array
    {
        // Use Laravel Collection for sorting and filtering
        $scoreCollection = collect($scores)->sortDesc();
        $topTwo = $scoreCollection->take(2);
        $topCodes = $topTwo->keys()->toArray(); // e.g. ['R', 'I']

        // Find matching majors based on Top-2 RIASEC codes
        $recommendedMajors = $this->findMatchingMajors($topCodes, $scoreCollection);

        // Determine the primary recommendation (highest ranked major)
        $primaryMajor = $recommendedMajors->first();
        $recommendation = $primaryMajor
            ? "{$primaryMajor['level']} - {$primaryMajor['name']}"
            : ($this->isSmkType($topCodes) ? 'SMK' : 'SMA');

        // Build detailed reasoning
        $topNames = collect($topCodes)->map(fn($c) => $this->getCategoryName($c))->implode(' dan ');
        $reasoning = $this->buildReasoning($topCodes, $topNames, $recommendedMajors);

        return [
            'recommendation' => $recommendation,
            'reasoning' => $reasoning,
            'dominant_category' => $topCodes[0],
            'recommended_majors' => $recommendedMajors->toArray(),
        ];
    }

    /**
     * Find top 3 matching majors based on RIASEC codes and scores.
     */
    private function findMatchingMajors(array $topCodes, Collection $scores): Collection
    {
        $allMajors = Major::all();

        if ($allMajors->isEmpty()) {
            return collect();
        }

        // Score each major based on how well it matches the student's RIASEC profile
        $scoredMajors = $allMajors->map(function (Major $major) use ($topCodes, $scores) {
            $majorCodes = $major->riasec_codes; // accessor splits "R,I" into ['R','I']
            $matchScore = 0;

            // Primary match: check if major codes overlap with top-2 student codes
            $overlap = array_intersect($majorCodes, $topCodes);
            $matchScore += count($overlap) * 50; // 50 points per matching code

            // Secondary match: sum of actual student scores for the major's RIASEC codes
            foreach ($majorCodes as $code) {
                $matchScore += $scores->get($code, 0);
            }

            // Bonus for exact match (both codes match in order)
            if (count($overlap) === 2) {
                $matchScore += 30;
            }

            return [
                'major_id' => $major->id,
                'name' => $major->name,
                'level' => $major->level,
                'description' => $major->description,
                'dominant_riasec_code' => $major->dominant_riasec_code,
                'match_score' => $matchScore,
            ];
        });

        // Sort by match score descending and take top 3
        return $scoredMajors->sortByDesc('match_score')->take(3)->values();
    }

    /**
     * Determine if the top codes lean toward SMK.
     */
    private function isSmkType(array $topCodes): bool
    {
        $smkLeaning = ['R', 'C'];
        return count(array_intersect($topCodes, $smkLeaning)) > 0;
    }

    /**
     * Build a comprehensive reasoning text.
     */
    private function buildReasoning(array $topCodes, string $topNames, Collection $majors): string
    {
        $codeKey = implode(',', $topCodes);

        // Specific mapping descriptions
        $mappingDescriptions = [
            'R,I' => 'Kombinasi Realistic dan Investigative menunjukkan Anda memiliki kemampuan teknis dan analitis yang kuat. Anda cocok di bidang teknologi, engineering, dan sains terapan.',
            'I,R' => 'Kombinasi Investigative dan Realistic menunjukkan Anda memiliki kemampuan analitis yang didukung keterampilan praktis. Cocok untuk bidang sains terapan dan teknik.',
            'A,S' => 'Kombinasi Artistic dan Social menunjukkan Anda kreatif sekaligus komunikatif. Cocok di bidang desain, seni komunikasi, dan bahasa.',
            'S,A' => 'Kombinasi Social dan Artistic menunjukkan Anda suka berinteraksi dan memiliki kreativitas tinggi. Cocok di bidang pendidikan seni, komunikasi, dan humaniora.',
            'C,E' => 'Kombinasi Conventional dan Enterprising menunjukkan Anda terorganisir dan berjiwa bisnis. Cocok di bidang akuntansi, manajemen, dan administrasi bisnis.',
            'E,C' => 'Kombinasi Enterprising dan Conventional menunjukkan Anda memiliki jiwa kepemimpinan yang didukung kemampuan administratif. Cocok di bidang bisnis dan manajemen.',
            'I,S' => 'Kombinasi Investigative dan Social menunjukkan Anda analitis sekaligus peduli dengan sesama. Cocok untuk jalur akademik menuju kedokteran, psikologi, atau sains kesehatan.',
            'S,I' => 'Kombinasi Social dan Investigative menunjukkan Anda suka membantu orang lain dengan pendekatan ilmiah. Cocok di bidang kesehatan, pendidikan, dan pengembangan masyarakat.',
            'R,C' => 'Kombinasi Realistic dan Conventional menunjukkan Anda menyukai pekerjaan teknis yang terstruktur. Cocok di bidang teknologi jaringan, administrasi IT, dan teknik.',
            'R,E' => 'Kombinasi Realistic dan Enterprising menunjukkan Anda praktis dan berjiwa wirausaha. Cocok di bidang otomotif, teknik, dan bisnis manufaktur.',
            'E,S' => 'Kombinasi Enterprising dan Social menunjukkan Anda pemimpin yang komunikatif. Cocok di bidang bisnis, hukum, dan ilmu sosial.',
            'S,E' => 'Kombinasi Social dan Enterprising menunjukkan Anda suka berinteraksi dan memimpin. Cocok di bidang pariwisata, manajemen SDM, dan layanan publik.',
            'A,R' => 'Kombinasi Artistic dan Realistic menunjukkan Anda kreatif dan terampil secara manual. Cocok di bidang seni rupa, kerajinan, dan desain produk.',
            'A,E' => 'Kombinasi Artistic dan Enterprising menunjukkan Anda kreatif dan ambisius. Cocok di bidang komunikasi, hubungan internasional, dan media.',
            'I,C' => 'Kombinasi Investigative dan Conventional menunjukkan Anda analitis dan teliti. Cocok di bidang farmasi, laboratorium, dan riset.',
            'C,S' => 'Kombinasi Conventional dan Social menunjukkan Anda terorganisir dan suka bekerja dalam tim. Cocok di bidang administrasi, manajemen perkantoran, dan sekretaris.',
        ];

        $baseReasoning = $mappingDescriptions[$codeKey]
            ?? "Profil dominan Anda adalah {$topNames}. Berdasarkan kombinasi ini, kami merekomendasikan jurusan yang sesuai dengan kekuatan kepribadian Anda.";

        // Add major-specific details
        if ($majors->isNotEmpty()) {
            $majorNames = $majors->map(fn($m) => "{$m['level']} {$m['name']}")->implode(', ');
            $baseReasoning .= " Rekomendasi jurusan terbaik untuk Anda: {$majorNames}.";
        }

        return $baseReasoning;
    }

    private function getCategoryName(string $cat): string
    {
        return [
            'R' => 'Realistic (Praktis)',
            'I' => 'Investigative (Pemikir)',
            'A' => 'Artistic (Kreatif)',
            'S' => 'Social (Penolong)',
            'E' => 'Enterprising (Wirausaha)',
            'C' => 'Conventional (Terorganisir)',
        ][$cat] ?? $cat;
    }
}
