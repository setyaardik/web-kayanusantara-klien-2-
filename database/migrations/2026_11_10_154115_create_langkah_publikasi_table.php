<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('langkah_publikasi', function (Blueprint $table) {
            $table->id();
            $table->text('judul');
            $table->string('url');
            $table->string('label_tombol')->default('Lihat');
            $table->unsignedInteger('urutan')->default(0);
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('langkah_publikasi'); }
};
