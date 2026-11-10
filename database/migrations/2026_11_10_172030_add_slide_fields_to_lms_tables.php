<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('materi', function (Blueprint $table) {
            if (!Schema::hasColumn('materi', 'kelas_id')) {
                $table->foreignId('kelas_id')->nullable()->after('unsur_id')->constrained('kelas')->nullOnDelete();
            }
            if (!Schema::hasColumn('materi', 'rangkuman')) {
                $table->text('rangkuman')->nullable()->after('judul');
            }
            if (!Schema::hasColumn('materi', 'submateri_count')) {
                $table->unsignedTinyInteger('submateri_count')->default(0)->after('rangkuman');
            }
        });

        Schema::table('diskusi', function (Blueprint $table) {
            if (!Schema::hasColumn('diskusi', 'pertanyaan_pematik')) {
                $table->text('pertanyaan_pematik')->nullable()->after('judul');
            }
        });
    }

    public function down(): void
    {
        Schema::table('materi', function (Blueprint $table) {
            if (Schema::hasColumn('materi', 'kelas_id')) {
                $table->dropConstrainedForeignId('kelas_id');
            }
            foreach (['rangkuman', 'submateri_count'] as $col) {
                if (Schema::hasColumn('materi', $col)) $table->dropColumn($col);
            }
        });
        Schema::table('diskusi', function (Blueprint $table) {
            if (Schema::hasColumn('diskusi', 'pertanyaan_pematik')) {
                $table->dropColumn('pertanyaan_pematik');
            }
        });
    }
};
