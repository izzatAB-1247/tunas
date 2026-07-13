<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\KonselingGroup;
use App\Models\KonselingMember;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $admin = User::factory()->admin()->create([
            'nama_depan' => 'Admin',
            'nama_belakang' => 'TUNAS',
            'email' => 'admin@tunas.com',
            'password' => 'password',
        ]);

        $guru = User::factory()->guru()->create([
            'nama_depan' => 'Budi',
            'nama_belakang' => 'Santoso',
            'email' => 'guru@tunas.com',
            'password' => 'password',
        ]);

        Guru::create([
            'user_id' => $guru->id,
            'nip' => '1987654321',
        ]);

        $siswa = User::factory()->create([
            'nama_depan' => 'Ani',
            'nama_belakang' => 'Putri',
            'email' => 'siswa@tunas.com',
            'password' => 'password',
        ]);

        Siswa::create([
            'user_id' => $siswa->id,
            'nis' => '1234567890',
            'kelas' => '12',
        ]);

        $group = KonselingGroup::create([
            'guru_id' => $guru->id,
            'nama' => 'Konseling Karier',
            'deskripsi' => 'Grup konseling untuk persiapan karier setelah lulus.',
            'kuota' => 15,
            'hari' => 'Rabu',
            'waktu_mulai' => '14:00',
            'waktu_selesai' => '15:30',
            'status' => 'aktif',
        ]);

        KonselingMember::create([
            'group_id' => $group->id,
            'siswa_id' => $siswa->id,
            'status' => 'approved',
            'approved_at' => now(),
        ]);
    }
}
