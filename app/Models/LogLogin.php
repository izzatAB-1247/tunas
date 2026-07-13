<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogLogin extends Model
{
    protected $table = 'log_login';

    protected $fillable = [
        'siswa_user_id',
        'guru_user_id',
        'waktu_login',
    ];

    protected function casts(): array
    {
        return [
            'waktu_login' => 'datetime',
        ];
    }

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(User::class, 'siswa_user_id');
    }

    public function guru(): BelongsTo
    {
        return $this->belongsTo(User::class, 'guru_user_id');
    }
}
