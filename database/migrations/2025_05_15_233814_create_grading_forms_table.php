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
        Schema::create('grading_forms', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('student_name');
            $table->string('student_number');
            $table->string('company_name');
            $table->string('company_place');
            $table->date('start_period')->nullable();
            $table->date('end_period')->nullable();
            $table->string('oe_code');
            $table->string('title_assignment');
            $table->boolean('retry')->default(false);
            $table->date('grading_date')->nullable();
//            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
//            $table->foreignId('teacher_id')->constrained('users')->onDelete('cascade');
//            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grading_forms');
    }
};
