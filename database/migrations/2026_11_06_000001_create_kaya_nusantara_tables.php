<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Skema inti Kaya Nusantara.
 * - unsur_budaya: 7 unsur kebudayaan (Bahasa, Sistem Pengetahuan, dst.)
 * - materi: artikel/materi per unsur (halaman Selasar Budaya)
 * - kuis + kuis_soal: "Uji Pengetahuanmu"
 * - kelas + kelas_user: kelas digital (guru membuat, siswa join via kode)
 * - tugas + submissions: tugas & pengumpulan karya siswa
 */
return new class extends Migration
{
    public function up(): void
    {
        // 7 unsur kebudayaan
        Schema::create('unsur_budaya', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();          // bahasa, sistem-pengetahuan, ...
            $table->string('nama');                     // Bahasa
            $table->string('ikon')->nullable();         // path ikon/emoji
            $table->text('ringkasan');                  // deskripsi singkat (kartu)
            $table->text('deskripsi')->nullable();      // detail halaman unsur
            $table->string('cover')->nullable();        // path gambar cover
            $table->unsignedSmallInteger('urutan')->default(0);
            $table->timestamps();
        });

        // Materi pembelajaran per unsur
        Schema::create('materi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unsur_id')->constrained('unsur_budaya')->cascadeOnDelete();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('ringkasan')->nullable();
            $table->longText('isi');                    // konten lengkap (HTML/markdown)
            $table->string('cover')->nullable();
            $table->enum('status', ['draft', 'publikasi'])->default('draft');
            $table->unsignedBigInteger('dilihat')->default(0);
            $table->timestamps();

            $table->index(['unsur_id', 'status']);
        });

        // Kuis "Uji Pengetahuanmu"
        Schema::create('kuis', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->foreignId('unsur_id')->nullable()->constrained('unsur_budaya')->nullOnDelete(); // null = kuis campuran
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });

        Schema::create('kuis_soal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kuis_id')->constrained('kuis')->cascadeOnDelete();
            $table->text('pertanyaan');
            $table->json('pilihan');                    // ["a", "b", "c", "d"]
            $table->unsignedTinyInteger('jawaban');     // index pilihan benar
            $table->text('penjelasan')->nullable();
            $table->unsignedSmallInteger('urutan')->default(0);
            $table->timestamps();
        });

        // Kelas digital (guru membuat, siswa join via kode)
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guru_id')->constrained('users')->cascadeOnDelete();
            $table->string('nama');                     // "Kelas XI IPA 1"
            $table->string('kode', 8)->unique();        // kode join
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        Schema::create('kelas_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_id')->constrained('kelas')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamp('bergabung_pada')->useCurrent();
            $table->unique(['kelas_id', 'user_id']);
        });

        // Tugas dari guru
        Schema::create('tugas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_id')->constrained('kelas')->cascadeOnDelete();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->timestamp('deadline')->nullable();
            $table->timestamps();

            $table->index(['kelas_id', 'deadline']);
        });

        // Pengumpulan karya siswa
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tugas_id')->constrained('tugas')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('file_path')->nullable();    // file di storage, bukan di DB
            $table->text('catatan')->nullable();
            $table->unsignedTinyInteger('nilai')->nullable(); // 0-100
            $table->text('feedback_guru')->nullable();
            $table->timestamp('dinilai_pada')->nullable();
            $table->timestamps();

            $table->unique(['tugas_id', 'user_id']);    // 1 siswa 1 submission per tugas
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('submissions');
        Schema::dropIfExists('tugas');
        Schema::dropIfExists('kelas_user');
        Schema::dropIfExists('kelas');
        Schema::dropIfExists('kuis_soal');
        Schema::dropIfExists('kuis');
        Schema::dropIfExists('materi');
        Schema::dropIfExists('unsur_budaya');
    }
};
