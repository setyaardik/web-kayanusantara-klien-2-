<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnsurBudaya extends Model
{
    protected $table = 'unsur_budaya';

    protected $fillable = ['slug', 'nama', 'ikon', 'ringkasan', 'deskripsi', 'cover', 'urutan'];

    public function progres()
    {
        return $this->hasMany(ProgresMateri::class, 'unsur_id');
    }
}
