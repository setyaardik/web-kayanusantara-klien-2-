<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('sekolah')->nullable()->after('role');
            $table->string('kelas')->nullable()->after('sekolah');
        });

        Schema::table('kelas', function (Blueprint $table) {
            $table->enum('tingkat', ['X', 'XI', 'XII'])->nullable()->after('nama');
        });

        Schema::create('progres_materi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('unsur_id')->constrained('unsur_budaya')->cascadeOnDelete();
            $table->unsignedTinyInteger('persen')->default(0);
            $table->timestamp('selesai_pada')->nullable();
            $table->timestamps();
            $table->unique(['user_id', 'unsur_id']);
        });

        Schema::create('diskusi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('unsur_id')->nullable()->constrained('unsur_budaya')->nullOnDelete();
            $table->string('judul');
            $table->timestamps();
        });

        Schema::create('tanggapan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('diskusi_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->text('isi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tanggapan');
        Schema::dropIfExists('diskusi');
        Schema::dropIfExists('progres_materi');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['sekolah', 'kelas']);
        });
        Schema::table('kelas', function (Blueprint $table) {
            $table->dropColumn('tingkat');
        });
    }
};
