<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_page_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_siswa_can_register(): void
    {
        $response = $this->post('/register', [
            'nama_depan' => 'Test',
            'nama_belakang' => 'User',
            'email' => 'test@example.com',
            'telepon' => '08123456789',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'siswa',
            'nis' => '1234567890',
            'kelas' => '10',
        ]);

        $response->assertRedirect('/login');

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'role' => 'siswa',
        ]);

        $user = User::where('email', 'test@example.com')->first();
        $this->assertDatabaseHas('siswa', [
            'user_id' => $user->id,
            'nis' => '1234567890',
            'kelas' => '10',
        ]);
    }

    public function test_new_guru_can_register(): void
    {
        $response = $this->post('/register', [
            'nama_depan' => 'Test',
            'nama_belakang' => 'Guru',
            'email' => 'guru@example.com',
            'telepon' => '08123456789',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'guru',
            'nip' => '1987654321',
        ]);

        $response->assertRedirect('/login');

        $this->assertDatabaseHas('users', [
            'email' => 'guru@example.com',
            'role' => 'guru',
        ]);

        $user = User::where('email', 'guru@example.com')->first();
        $this->assertDatabaseHas('guru', [
            'user_id' => $user->id,
            'nip' => '1987654321',
        ]);
    }

    public function test_register_fails_with_missing_fields(): void
    {
        $response = $this->post('/register', [
            'nama_depan' => '',
            'email' => 'not-an-email',
            'password' => 'short',
        ]);

        $response->assertSessionHasErrors(['nama_depan', 'email', 'password', 'role']);
    }

    public function test_register_fails_with_duplicate_email(): void
    {
        User::factory()->create(['email' => 'existing@example.com']);

        $response = $this->post('/register', [
            'nama_depan' => 'Test',
            'nama_belakang' => 'User',
            'email' => 'existing@example.com',
            'telepon' => '08123456789',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'siswa',
            'nis' => '1234567890',
            'kelas' => '10',
        ]);

        $response->assertSessionHasErrors(['email']);
    }
}
