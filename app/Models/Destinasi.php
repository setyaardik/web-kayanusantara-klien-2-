<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destinasi extends Model
{
    protected $fillable = ['nama', 'slug', 'daerah', 'deskripsi', 'gambar', 'tour_url', 'urutan', 'aktif'];

    protected $casts = ['aktif' => 'boolean'];
}
