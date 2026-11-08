<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('bulan');          // 1-12
            $table->string('kategori');                      // Tradisi Adat, Festival budaya, ...
            $table->string('nama');                          // PASOLA - Sumba, ...
            $table->string('tanggal_label');                 // 15 Februari 2027
            $table->text('deskripsi');
            $table->unsignedSmallInteger('urutan')->default(0);
            $table->timestamps();
        });

        $now = now();
        DB::table('agendas')->insert([
            ['bulan' => 2,  'kategori' => 'Tradisi Adat',         'nama' => 'PASOLA - Sumba, Nusa Tenggara Timur',                  'tanggal_label' => '15 Februari 2027',   'deskripsi' => 'Tradisi berkuda dan permainan lembing sebagai bagian dari ritual adat masyarakat Sumba.',              'urutan' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['bulan' => 3,  'kategori' => 'Festival budaya',      'nama' => 'Festival Danau Sentani - Jayapura, Papua',             'tanggal_label' => '28 Maret 2027',      'deskripsi' => 'Perayaan budaya yang menampilkan seni, tarian, kerajinan, dan kekayaan masyarakat sekitar Danau Sentani.', 'urutan' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['bulan' => 6,  'kategori' => 'Seni & budaya',        'nama' => 'Pesta Kesenian Bali - Bali',                            'tanggal_label' => '13 Juni 2027',       'deskripsi' => 'Ajang pertunjukan seni tari, musik, kerajinan, dan budaya Bali.',                                    'urutan' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['bulan' => 8,  'kategori' => 'Festival budaya',      'nama' => 'Dieng Culture Festival - Dieng, Jawa Tengah',           'tanggal_label' => '1 Agustus 2027',     'deskripsi' => 'Festival budaya dan tradisi masyarakat dataran tinggi Dieng.',                                     'urutan' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['bulan' => 9,  'kategori' => 'Tradisi adat',         'nama' => 'Tabuik - Pariaman, Sumatera Barat',                      'tanggal_label' => '9 September 2027',   'deskripsi' => 'Tradisi budaya masyarakat Pariaman yang berlangsung pada bulan Muharam.',                            'urutan' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['bulan' => 10, 'kategori' => 'Peringatan nasional',  'nama' => 'Hari Batik Nasional - Seluruh Indonesia',                'tanggal_label' => '2 Oktober 2027',     'deskripsi' => 'Peringatan untuk mengenal, menggunakan, dan melestarikan batik sebagai warisan budaya.',                'urutan' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['bulan' => 11, 'kategori' => 'Tradisi adat',         'nama' => 'Erau - Kutai Kartanegara, Kalimantan Timur',             'tanggal_label' => '20 November 2027',   'deskripsi' => 'Perayaan adat yang menampilkan tradisi dan kebudayaan Kesultanan Kutai.',                            'urutan' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['bulan' => 12, 'kategori' => 'Tradisi budaya',       'nama' => 'Sekaten - Yogyakarta dan Surakarta',                     'tanggal_label' => '4 Desember 2027',    'deskripsi' => 'Perayaan tradisi yang berkaitan dengan peringatan Maulid Nabi dan budaya keraton.',                    'urutan' => 1, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};
