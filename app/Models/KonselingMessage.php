<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KonselingMessage extends Model
{
    protected $fillable = [
        'group_id',
        'user_id',
        'pesan',
        'tipe',
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(KonselingGroup::class, 'group_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
