<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grade_id')->constrained()->onDelete('cascade');  // Foreign to Item model
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Foreign to User model
            $table->timestamps();
            $table->unique(['grade_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('approvals');
    }
};
