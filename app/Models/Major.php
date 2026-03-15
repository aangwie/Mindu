<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    protected $fillable = [
        'name',
        'level',
        'dominant_riasec_code',
        'description',
    ];

    /**
     * Majors that were recommended in test results.
     */
    public function testResults(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(TestResult::class, 'test_result_majors')
            ->withPivot('rank', 'match_score')
            ->withTimestamps()
            ->orderByPivot('rank');
    }

    /**
     * Get the RIASEC codes as an array.
     */
    public function getRiasecCodesAttribute(): array
    {
        return array_map('trim', explode(',', $this->dominant_riasec_code));
    }
}
