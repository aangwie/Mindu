<?php

namespace App\Services;

use App\Models\Option;
use App\Models\Question;

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
     * Determine recommendation based on RIASEC scores and user interest.
     */
    public function getRecommendation(array $scores, ?string $userInterest): array
    {
        // 1. Find the dominant category (highest score)
        arsort($scores);
        $dominantCategory = key($scores);
        $highestScore = current($scores);

        // Check for ties in the highest score
        $topCategories = array_keys($scores, $highestScore);

        $finalDominant = $dominantCategory;
        if (count($topCategories) > 1 && $userInterest) {
            // Tie-breaker: If user interest matches one of the top categories (roughly), or just use it as logic
            // More direct: if it's a tie, and userInterest is SMK, and one of top is R or C, pick that.
            if ($userInterest === 'SMK') {
                foreach ($topCategories as $cat) {
                    if (in_array($cat, ['R', 'C'])) {
                        $finalDominant = $cat;
                        break;
                    }
                }
            } elseif ($userInterest === 'SMA') {
                foreach ($topCategories as $cat) {
                    if (in_array($cat, ['I', 'A'])) {
                        $finalDominant = $cat;
                        break;
                    }
                }
            }
        }

        // Decision Tree Logic
        $recommendation = 'SMA';
        $reasoning = '';

        if (in_array($finalDominant, ['R', 'C'])) {
            $recommendation = 'SMK';
            $reasoning = "Hasil dominan Anda adalah " . $this->getCategoryName($finalDominant) . ". Tipe ini cenderung menyukai pekerjaan teknis, praktis, dan terstruktur yang sangat cocok untuk jalur SMK.";
        } elseif (in_array($finalDominant, ['I', 'A'])) {
            $recommendation = 'SMA';
            $reasoning = "Hasil dominan Anda adalah " . $this->getCategoryName($finalDominant) . ". Tipe ini cenderung menyukai eksplorasi ide, penelitian, dan kreativitas yang lebih optimal dikembangkan di jalur akademik SMA.";
        } else {
            // S or E (Social or Enterprising)
            // Use user_interest if available, otherwise default to SMA for these "broad" categories
            if ($userInterest) {
                $recommendation = $userInterest;
                $reasoning = "Hasil dominan Anda adalah " . $this->getCategoryName($finalDominant) . ". Karena tipe ini memiliki minat yang fleksibel, rekomendasi disesuaikan dengan minat pribadi Anda untuk ke " . $userInterest . ".";
            } else {
                $recommendation = 'SMA';
                $reasoning = "Hasil dominan Anda adalah " . $this->getCategoryName($finalDominant) . ". Tipe ini mengutamakan interaksi sosial atau kepemimpinan, yang secara umum dapat disiapkan dengan baik melalui pendidikan menengah umum SMA.";
            }
        }

        return [
            'recommendation' => $recommendation,
            'reasoning' => $reasoning,
            'dominant_category' => $finalDominant
        ];
    }

    private function getCategoryName(string $cat): string
    {
        return [
            'R' => 'Realistic (Praktis)',
            'I' => 'Investigative (Pemikir)',
            'A' => 'Artistic (Kreatif)',
            'S' => 'Social (Penolong)',
            'E' => 'Enterprising (Penuh Usaha)',
            'C' => 'Conventional (Terorganisir)',
        ][$cat] ?? $cat;
    }
}
