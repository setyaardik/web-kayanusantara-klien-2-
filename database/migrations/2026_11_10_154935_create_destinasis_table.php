<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('destinasis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->nullable();
            $table->string('daerah');
            $table->text('deskripsi');
            $table->string('gambar');
            $table->string('tour_url')->nullable();
            $table->unsignedInteger('urutan')->default(0);
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('destinasis');
    }
};
