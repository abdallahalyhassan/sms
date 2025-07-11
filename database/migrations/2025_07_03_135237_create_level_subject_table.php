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
        Schema::create('level_subject', function (Blueprint $table) {
            $table->foreignId('level_id')->constrained();
            $table->foreignId('subject_id')->constrained();
            $table->primary(['level_id', 'subject_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('level_subject');
    }
};
