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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained();
            $table->foreignId('subject_id')->constrained();
            $table->foreignId('teacher_id')->constrained();
            $table->string('day_of_week');
            $table->integer('period');
            $table->timestamps();

            $table->unique(['class_id', 'day_of_week', 'period']);
            $table->unique(['teacher_id', 'day_of_week', 'period']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules_');
    }
};
