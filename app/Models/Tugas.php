<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    protected $table = 'tugas';

    protected $casts = ['deadline' => 'datetime'];

    protected $fillable = ['kelas_id', 'judul', 'deskripsi', 'deadline'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}
