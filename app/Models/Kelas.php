<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $fillable = ['guru_id', 'nama', 'tingkat', 'deskripsi'];

    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    public function siswa()
    {
        return $this->hasMany(User::class, 'kelas', 'nama')->where('role', 'siswa');
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }
}
