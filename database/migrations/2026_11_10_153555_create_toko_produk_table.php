<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('toko_produk', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->json('detail');
            $table->string('penulis');
            $table->string('harga');
            $table->string('gambar');
            $table->unsignedInteger('urutan')->default(0);
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('toko_produk');
    }
};
