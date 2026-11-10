<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'berita';

    protected $fillable = ['judul', 'excerpt', 'gambar', 'url', 'urutan', 'aktif'];

    protected $casts = [
        'aktif' => 'boolean',
    ];
}
