<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('langkah_dokumentasi', function (Blueprint $table) {
            $table->id();
            $table->string('gambar');
            $table->string('alt');
            $table->string('kelas')->nullable();
            $table->unsignedInteger('urutan')->default(0);
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('langkah_dokumentasi'); }
};
