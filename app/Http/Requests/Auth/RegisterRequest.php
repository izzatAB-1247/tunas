<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'role' => 'required|in:guru,siswa',
            'nama_depan' => 'required|string|max:255',
            'nama_belakang' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'telepon' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string',
            'nip' => 'required_if:role,guru|string|max:50',
            'nis' => 'required_if:role,siswa|string|max:50',
            'kelas' => 'required_if:role,siswa|string|max:10',
        ];
    }
}
