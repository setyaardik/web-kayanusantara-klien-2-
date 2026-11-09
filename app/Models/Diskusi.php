<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diskusi extends Model
{
    protected $table = 'diskusi';

    protected $fillable = ['user_id', 'unsur_id', 'judul'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function unsur()
    {
        return $this->belongsTo(UnsurBudaya::class, 'unsur_id');
    }

    public function tanggapan()
    {
        return $this->hasMany(Tanggapan::class);
    }
}
