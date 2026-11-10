<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Mitra extends Model
{
    protected $fillable = ['nama','logo','urutan','aktif'];
    protected $casts = ['aktif' => 'boolean'];
}
