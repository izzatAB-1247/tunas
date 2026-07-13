<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $user = User::create([
            'nama_depan' => $data['nama_depan'],
            'nama_belakang' => $data['nama_belakang'],
            'email' => $data['email'],
            'telepon' => $data['telepon'],
            'password' => $data['password'],
            'role' => $data['role'],
        ]);

        if ($data['role'] === 'guru') {
            Guru::create([
                'user_id' => $user->id,
                'nip' => $data['nip'],
            ]);
        }

        if ($data['role'] === 'siswa') {
            Siswa::create([
                'user_id' => $user->id,
                'nis' => $data['nis'],
                'kelas' => $data['kelas'],
            ]);
        }

        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
