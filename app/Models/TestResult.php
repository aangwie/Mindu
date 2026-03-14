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

    public function getDominantCategoryAttribute(): string
    {
        $scores = [
            'Realistic' => $this->score_r,
            'Investigative' => $this->score_i,
            'Artistic' => $this->score_a,
            'Social' => $this->score_s,
            'Enterprising' => $this->score_e,
            'Conventional' => $this->score_c,
        ];

        arsort($scores);
        return array_key_first($scores);
    }
}
