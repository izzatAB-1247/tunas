<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kuis extends Model
{
    protected $table = 'kuis';

    protected $fillable = [
        'pertanyaan',
        'emoji',
        'opsi_a',
        'opsi_b',
        'opsi_c',
        'opsi_d',
        'jawaban_benar',
        'tipe',
    ];

    protected function casts(): array
    {
        return [
            'jawaban_benar' => 'integer',
        ];
    }
}
