<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         Schema::create('questions', function (Blueprint $table) {
        $table->id();
        $table->string('type'); // 'mcq' or 'tf'
        $table->text('question');
        $table->json('options')->nullable(); // For MCQ questions
        $table->string('correct_answer');
        $table->integer('points')->default(1);
        $table->foreignId('subject_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qestions');
    }
};
