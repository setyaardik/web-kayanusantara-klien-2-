<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TokoProduk extends Model
{
    protected $table = 'toko_produk';

    protected $fillable = ['judul', 'detail', 'penulis', 'harga', 'gambar', 'urutan', 'aktif'];

    protected $casts = [
        'detail' => 'array',
        'aktif' => 'boolean',
    ];
}
