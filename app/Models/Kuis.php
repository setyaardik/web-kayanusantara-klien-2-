<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kuis extends Model
{
    protected $table = 'kuis';

    protected $fillable = ['judul', 'deskripsi', 'jenis', 'tenggat', 'kelas_id', 'unsur_id', 'aktif'];

    protected $casts = ['tenggat' => 'datetime'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function soal()
    {
        return $this->hasMany(KuisSoal::class, 'kuis_id');
    }
}
