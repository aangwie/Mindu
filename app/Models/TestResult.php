<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    protected $fillable = [
        'test_session_id',
        'score_r',
        'score_i',
        'score_a',
        'score_s',
        'score_e',
        'score_c',
        'recommendation',
        'final_reasoning',
    ];

    public function testSession(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TestSession::class);
    }

    /**
     * Recommended majors for this test result.
     */
    public function majors(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Major::class, 'test_result_majors')
            ->withPivot('rank', 'match_score')
            ->withTimestamps()
            ->orderByPivot('rank');
    }

    /**
     * Get the dominant RIASEC category.
     */
    public function getDominantCategoryAttribute(): string
    {
        $scores = collect([
            'Realistic' => $this->score_r,
            'Investigative' => $this->score_i,
            'Artistic' => $this->score_a,
            'Social' => $this->score_s,
            'Enterprising' => $this->score_e,
            'Conventional' => $this->score_c,
        ]);

        return $scores->sortDesc()->keys()->first();
    }

    /**
     * Get detailed recommendation explanation for each recommended major.
     */
    public function getRecommendationDetails(): array
    {
        $scores = collect([
            'R' => $this->score_r,
            'I' => $this->score_i,
            'A' => $this->score_a,
            'S' => $this->score_s,
            'E' => $this->score_e,
            'C' => $this->score_c,
        ]);

        $topTwo = $scores->sortDesc()->take(2);
        $topCodes = $topTwo->keys()->implode(' dan ');

        $categoryNames = [
            'R' => 'Realistic (Praktis)',
            'I' => 'Investigative (Pemikir)',
            'A' => 'Artistic (Kreatif)',
            'S' => 'Social (Penolong)',
            'E' => 'Enterprising (Wirausaha)',
            'C' => 'Conventional (Terorganisir)',
        ];

        $topNames = $topTwo->keys()->map(fn($code) => $categoryNames[$code])->implode(' dan ');

        $details = [];
        foreach ($this->majors as $index => $major) {
            $details[] = [
                'rank' => $major->pivot->rank,
                'major' => $major->name,
                'level' => $major->level,
                'match_score' => $major->pivot->match_score,
                'description' => $major->description,
                'reasoning' => "Berdasarkan profil kepribadian Anda yang dominan di {$topNames} (skor tertinggi: {$topCodes}), jurusan {$major->name} ({$major->level}) sangat sesuai karena jurusan ini membutuhkan karakteristik yang cocok dengan tipe kepribadian Anda.",
            ];
        }

        return $details;
    }
}
