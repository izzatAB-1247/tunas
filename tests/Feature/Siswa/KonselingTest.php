<?php

namespace Tests\Feature\Siswa;

use App\Models\Guru;
use App\Models\KonselingGroup;
use App\Models\KonselingMember;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KonselingTest extends TestCase
{
    use RefreshDatabase;

    private User $siswa;

    private User $guru;

    private KonselingGroup $group;

    protected function setUp(): void
    {
        parent::setUp();

        $this->siswa = User::factory()->create(['role' => 'siswa']);
        Siswa::create(['user_id' => $this->siswa->id, 'nis' => '123456', 'kelas' => '10']);

        $this->guru = User::factory()->guru()->create();
        Guru::create(['user_id' => $this->guru->id, 'nip' => '123456']);

        $this->group = KonselingGroup::factory()->create(['guru_id' => $this->guru->id]);
    }

    public function test_siswa_can_see_available_groups(): void
    {
        $response = $this->actingAs($this->siswa)->getJson('/siswa/konseling');

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        $this->assertCount(1, $response->json('available_groups'));
        $this->assertCount(0, $response->json('my_groups'));
    }

    public function test_siswa_can_join_group(): void
    {
        $response = $this->actingAs($this->siswa)->postJson("/siswa/konseling/{$this->group->id}/join");

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        $this->assertDatabaseHas('konseling_members', [
            'group_id' => $this->group->id,
            'siswa_id' => $this->siswa->id,
            'status' => 'pending',
        ]);
    }

    public function test_siswa_cannot_join_same_group_twice(): void
    {
        $this->actingAs($this->siswa)->postJson("/siswa/konseling/{$this->group->id}/join");
        $response = $this->actingAs($this->siswa)->postJson("/siswa/konseling/{$this->group->id}/join");

        $response->assertStatus(422);
    }

    public function test_siswa_can_leave_group(): void
    {
        KonselingMember::create([
            'group_id' => $this->group->id,
            'siswa_id' => $this->siswa->id,
            'status' => 'approved',
        ]);

        $response = $this->actingAs($this->siswa)->postJson("/siswa/konseling/{$this->group->id}/leave");

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        $this->assertDatabaseMissing('konseling_members', [
            'group_id' => $this->group->id,
            'siswa_id' => $this->siswa->id,
        ]);
    }

    public function test_siswa_sees_joined_group_in_my_groups(): void
    {
        KonselingMember::create([
            'group_id' => $this->group->id,
            'siswa_id' => $this->siswa->id,
            'status' => 'approved',
        ]);

        $response = $this->actingAs($this->siswa)->getJson('/siswa/konseling');

        $response->assertStatus(200);
        $this->assertCount(1, $response->json('my_groups'));
        $this->assertCount(0, $response->json('available_groups'));
    }

    public function test_guru_cannot_access_siswa_konseling(): void
    {
        $response = $this->actingAs($this->guru)->getJson('/siswa/konseling');

        $response->assertStatus(403);
    }
}
