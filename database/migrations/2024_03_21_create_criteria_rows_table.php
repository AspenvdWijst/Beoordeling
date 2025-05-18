<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('criteria_rows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grading_table_id')->constrained()->onDelete('cascade');
            $table->string('component');
            $table->text('description')->nullable();
            $table->text('insufficient')->nullable();
            $table->text('sufficient')->nullable();
            $table->text('good')->nullable();
            $table->integer('points')->default(0);
            $table->text('remarks')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('criteria_rows');
    }
};
