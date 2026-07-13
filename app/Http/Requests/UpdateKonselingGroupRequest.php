<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKonselingGroupRequest extends FormRequest
{
    public function authorize(): bool
    {
        $group = $this->route('group');

        return $this->user()?->isGuru() && $group->guru_id === $this->user()->id;
    }

    public function rules(): array
    {
        return [
            'nama' => 'sometimes|string|max:255',
            'deskripsi' => 'nullable|string',
            'kuota' => 'sometimes|integer|min:1|max:100',
            'hari' => 'nullable|string|max:50',
            'waktu_mulai' => 'nullable|date_format:H:i',
            'waktu_selesai' => 'nullable|date_format:H:i|after:waktu_mulai',
            'status' => 'sometimes|in:aktif,selesai,dibatalkan',
        ];
    }
}
