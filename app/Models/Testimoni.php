<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Testimoni extends Model
{
    protected $fillable = ['inisial','nama','jabatan','teks','urutan','aktif'];
    protected $casts = ['aktif' => 'boolean'];
}
