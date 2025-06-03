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
        Schema::create('grading_result_drafts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grading_form_id')->constrained('grading_forms')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();
            $table->json('draft_data');
            $table->timestamps();

//            $table->unique(['grading_form_id', 'student_id', 'teacher_ids'], 'unique_draft');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grading_result_drafts');
    }
};
