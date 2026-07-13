<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KonselingSession extends Model
{
    protected $fillable = [
        'group_id',
        'judul',
        'deskripsi',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'tempat',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(KonselingGroup::class, 'group_id');
    }

    public function attendance(): HasMany
    {
        return $this->hasMany(KonselingAttendance::class, 'session_id');
    }

    public function reports(): HasMany
    {
        return $this->hasMany(KonselingReport::class, 'session_id');
    }
}
