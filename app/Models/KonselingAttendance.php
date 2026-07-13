<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KonselingAttendance extends Model
{
    protected $table = 'konseling_attendance';

    protected $fillable = [
        'session_id',
        'siswa_id',
        'status',
        'keterangan',
    ];

    public function session(): BelongsTo
    {
        return $this->belongsTo(KonselingSession::class, 'session_id');
    }

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }
}
