<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class LangkahGaleri extends Model
{
    protected $table = 'langkah_galeri';
    protected $fillable = ['judul','subjudul','url','label_tombol','urutan','aktif'];
    protected $casts = ['aktif' => 'boolean'];
}
