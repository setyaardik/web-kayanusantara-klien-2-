<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kuis', function (Blueprint $table) {
            $table->string('jenis')->nullable()->after('deskripsi');   // Pilihan Ganda, Esai Analitis, Studi Kasus, Proyek, Presentasi
            $table->timestamp('tenggat')->nullable()->after('jenis');
            $table->foreignId('kelas_id')->nullable()->after('tenggat')->constrained('kelas')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('kuis', function (Blueprint $table) {
            $table->dropColumn(['jenis', 'tenggat', 'kelas_id']);
        });
    }
};
