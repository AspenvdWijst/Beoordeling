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
        Schema::create('grading_tables', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('grading_form_id')->constrained('grading_forms')->cascadeOnDelete();
            $table->string('description_1')->nullable();
            $table->string('description_2')->nullable();
            $table->string('deliverable_text')->nullable();
            $table->boolean('deliverable_checked')->default(false);
            $table->integer('max_points')->default(0);
            $table->integer('min_points')->default(0);
            $table->string('point_range')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grading_tables');
    }
};
