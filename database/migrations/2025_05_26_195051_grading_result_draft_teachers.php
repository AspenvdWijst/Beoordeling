<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('grading_result_draft_teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grading_result_draft_id')->constrained()->cascadeOnDelete();
            $table->foreignId('teacher_id')->constrained('users')->cascadeOnDelete();
            $table->boolean('approved')->default(false);
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
            $table->unique(['grading_result_draft_id', 'teacher_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('grading_result_draft_teachers');
    }
};
