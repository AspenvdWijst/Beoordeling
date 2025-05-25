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
        Schema::create('table_points_ranges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grading_table_id')->constrained()->onDelete('cascade');
            $table->integer('min_points');
            $table->integer('max_points');
            $table->string('label');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_points_ranges');
    }
};
