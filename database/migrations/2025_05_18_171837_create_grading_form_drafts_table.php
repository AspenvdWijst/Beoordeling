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
        Schema::create('grading_form_drafts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->json('form_data');
            $table->timestamps();
        });

//        Schema::create('grading_form_draft_teacher', function (Blueprint $table) {
//            $table->id();
//            $table->foreignId('grading_form_draft_id')->constrained()->onDelete('cascade');
//            $table->foreignId('teacher_id')->constrained('users')->onDelete('cascade');
//        });
    }
    public function down(): void
    {
        Schema::dropIfExists('grading_form_drafts');
    }
};
