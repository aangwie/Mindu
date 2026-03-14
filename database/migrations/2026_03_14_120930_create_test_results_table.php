<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('test_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_session_id')->constrained()->cascadeOnDelete();
            $table->integer('score_r')->default(0);
            $table->integer('score_i')->default(0);
            $table->integer('score_a')->default(0);
            $table->integer('score_s')->default(0);
            $table->integer('score_e')->default(0);
            $table->integer('score_c')->default(0);
            $table->enum('recommendation', ['SMA', 'SMK']);
            $table->text('final_reasoning');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_results');
    }
};
