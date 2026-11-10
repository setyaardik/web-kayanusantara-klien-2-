<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class LangkahPublikasi extends Model
{
    protected $table = 'langkah_publikasi';
    protected $fillable = ['judul','url','label_tombol','urutan','aktif'];
    protected $casts = ['aktif' => 'boolean'];
}
