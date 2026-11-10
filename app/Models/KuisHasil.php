<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KuisHasil extends Model
{
    protected $table = 'kuis_hasil';

    protected $fillable = ['user_id', 'kuis_id', 'benar', 'total', 'skor'];
}
