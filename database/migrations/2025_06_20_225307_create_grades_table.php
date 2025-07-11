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
        Schema::create('grades', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('exam_id')->nullable()->constrained('exams')->onDelete('cascade');
            $table->foreignId('subject_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('type');
            $table->integer('grade');
            $table->integer('max_grade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
