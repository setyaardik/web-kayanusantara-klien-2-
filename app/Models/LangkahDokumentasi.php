<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class LangkahDokumentasi extends Model
{
    protected $table = 'langkah_dokumentasi';
    protected $fillable = ['gambar','alt','kelas','urutan','aktif'];
    protected $casts = ['aktif' => 'boolean'];
}
