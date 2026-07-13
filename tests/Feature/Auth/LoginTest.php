<?php

namespace Tests\Feature\Auth;

use App\Models\Guru;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_page_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect();
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    public function test_siswa_login_logs_entry(): void
    {
        $siswa = User::factory()->create(['role' => 'siswa']);
        Siswa::create(['user_id' => $siswa->id, 'nis' => '123456', 'kelas' => '10']);

        $guru = User::factory()->guru()->create();
        Guru::create(['user_id' => $guru->id, 'nip' => '123456']);

        $this->post('/login', [
            'email' => $siswa->email,
            'password' => 'password',
        ]);

        $this->assertDatabaseHas('log_login', [
            'siswa_user_id' => $siswa->id,
            'guru_user_id' => $guru->id,
        ]);
    }

    public function test_logout_destroys_session(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);
        $this->post('/logout');

        $this->assertGuest();
    }
}
