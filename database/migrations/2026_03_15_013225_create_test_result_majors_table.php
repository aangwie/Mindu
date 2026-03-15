<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('test_result_majors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_result_id')->constrained()->cascadeOnDelete();
            $table->foreignId('major_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('rank')->default(1); // 1, 2, or 3
            $table->unsignedInteger('match_score')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('test_result_majors');
    }
};
