<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('knockout_criterias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grading_table_id')->constrained()->cascadeOnDelete();
            $table->string('text');
            $table->boolean('checked')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('knockout_criterias');
    }
};
