<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KonselingReport extends Model
{
    protected $fillable = [
        'session_id',
        'siswa_id',
        'guru_id',
        'catatan',
        'evaluasi',
        'tindak_lanjut',
    ];

    public function session(): BelongsTo
    {
        return $this->belongsTo(KonselingSession::class, 'session_id');
    }

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }

    public function guru(): BelongsTo
    {
        return $this->belongsTo(User::class, 'guru_id');
    }
}
