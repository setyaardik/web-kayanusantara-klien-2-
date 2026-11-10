<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $table = 'materi';

    protected $fillable = ['unsur_id', 'kelas_id', 'judul', 'rangkuman', 'submateri_count', 'slug', 'ringkasan', 'isi', 'cover', 'status', 'dilihat'];

    public function unsur()
    {
        return $this->belongsTo(UnsurBudaya::class, 'unsur_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
