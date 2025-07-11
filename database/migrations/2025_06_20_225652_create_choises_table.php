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
        Schema::create('choises', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained()->onDelete('cascade');
            $table->boolean('is_correct');
            $table->string('choise_text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('choises');
    }
};
