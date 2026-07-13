<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karir extends Model
{
    protected $table = 'karir';

    protected $fillable = [
        'nama',
        'jabatan',
        'deskripsi',
        'pencapaian',
        'foto',
    ];
}
