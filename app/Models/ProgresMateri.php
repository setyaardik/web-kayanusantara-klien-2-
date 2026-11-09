<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgresMateri extends Model
{
    protected $table = 'progres_materi';

    protected $fillable = ['user_id', 'unsur_id', 'persen', 'selesai_pada'];

    public function unsur()
    {
        return $this->belongsTo(UnsurBudaya::class, 'unsur_id');
    }
}
