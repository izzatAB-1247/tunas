<?php

namespace Tests\Feature\Auth;

use App\Models\Guru;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_dashboard(): void
    {
        $response = $this->get('/guru/dashboard');

        $response->assertRedirect('/login');
    }

    public function test_guru_can_access_guru_dashboard(): void
    {
        $user = User::factory()->guru()->create();
        Guru::create(['user_id' => $user->id, 'nip' => '123456']);

        $response = $this->actingAs($user)->get('/guru/dashboard');

        $response->assertStatus(200);
    }

    public function test_siswa_cannot_access_guru_dashboard(): void
    {
        $user = User::factory()->create(['role' => 'siswa']);
        Siswa::create(['user_id' => $user->id, 'nis' => '123456', 'kelas' => '10']);

        $response = $this->actingAs($user)->get('/guru/dashboard');

        $response->assertStatus(403);
    }

    public function test_admin_cannot_access_guru_dashboard(): void
    {
        $user = User::factory()->admin()->create();

        $response = $this->actingAs($user)->get('/guru/dashboard');

        $response->assertStatus(403);
    }

    public function test_admin_can_access_admin_dashboard(): void
    {
        $user = User::factory()->admin()->create();

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertStatus(200);
    }

    public function test_guru_cannot_access_admin_dashboard(): void
    {
        $user = User::factory()->guru()->create();
        Guru::create(['user_id' => $user->id, 'nip' => '123456']);

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertStatus(403);
    }

    public function test_siswa_cannot_access_admin_dashboard(): void
    {
        $user = User::factory()->create(['role' => 'siswa']);
        Siswa::create(['user_id' => $user->id, 'nis' => '123456', 'kelas' => '10']);

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertStatus(403);
    }

    public function test_siswa_can_access_siswa_dashboard(): void
    {
        $user = User::factory()->create(['role' => 'siswa']);
        Siswa::create(['user_id' => $user->id, 'nis' => '123456', 'kelas' => '10']);

        $response = $this->actingAs($user)->get('/siswa/dashboard');

        $response->assertStatus(200);
    }

    public function test_guru_cannot_access_siswa_dashboard(): void
    {
        $user = User::factory()->guru()->create();
        Guru::create(['user_id' => $user->id, 'nip' => '123456']);

        $response = $this->actingAs($user)->get('/siswa/dashboard');

        $response->assertStatus(403);
    }
}
