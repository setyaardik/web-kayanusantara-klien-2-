<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kuis_hasil', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('kuis_id')->constrained()->cascadeOnDelete();
            $table->unsignedSmallInteger('benar')->default(0);
            $table->unsignedSmallInteger('total')->default(0);
            $table->unsignedTinyInteger('skor')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kuis_hasil');
    }
};
