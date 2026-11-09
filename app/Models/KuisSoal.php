<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KuisSoal extends Model
{
    protected $table = 'kuis_soal';

    protected $fillable = ['kuis_id', 'pertanyaan', 'pilihan', 'jawaban', 'penjelasan', 'urutan'];
}
