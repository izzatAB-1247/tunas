<?php

namespace App\Models;

use Database\Factories\KonselingGroupFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KonselingGroup extends Model
{
    /** @use HasFactory<KonselingGroupFactory> */
    use HasFactory;

    protected $fillable = [
        'guru_id',
        'nama',
        'deskripsi',
        'kuota',
        'hari',
        'waktu_mulai',
        'waktu_selesai',
        'status',
    ];

    public function guru(): BelongsTo
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    public function members(): HasMany
    {
        return $this->hasMany(KonselingMember::class, 'group_id');
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(KonselingSession::class, 'group_id');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(KonselingMessage::class, 'group_id');
    }

    public function approvedMembers(): HasMany
    {
        return $this->hasMany(KonselingMember::class, 'group_id')->where('status', 'approved');
    }

    public function pendingMembers(): HasMany
    {
        return $this->hasMany(KonselingMember::class, 'group_id')->where('status', 'pending');
    }
}
