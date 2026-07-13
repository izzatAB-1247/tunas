<?php

namespace Tests\Feature\Guru;

use App\Models\Guru;
use App\Models\KonselingGroup;
use App\Models\KonselingMember;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KonselingGroupTest extends TestCase
{
    use RefreshDatabase;

    private User $guru;

    protected function setUp(): void
    {
        parent::setUp();

        $this->guru = User::factory()->guru()->create();
        Guru::create(['user_id' => $this->guru->id, 'nip' => '123456']);
    }

    public function test_guru_can_create_group(): void
    {
        $response = $this->actingAs($this->guru)->postJson('/guru/konseling', [
            'nama' => 'Grup Konseling Test',
            'deskripsi' => 'Deskripsi grup',
            'kuota' => 10,
            'hari' => 'Senin',
            'waktu_mulai' => '09:00',
            'waktu_selesai' => '10:00',
        ]);

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        $this->assertDatabaseHas('konseling_groups', [
            'nama' => 'Grup Konseling Test',
            'guru_id' => $this->guru->id,
        ]);
    }

    public function test_guru_can_list_own_groups(): void
    {
        KonselingGroup::factory()->create(['guru_id' => $this->guru->id]);
        KonselingGroup::factory()->create(['guru_id' => $this->guru->id]);

        $response = $this->actingAs($this->guru)->getJson('/guru/konseling');

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        $this->assertCount(2, $response->json('groups'));
    }

    public function test_guru_can_update_group(): void
    {
        $group = KonselingGroup::factory()->create(['guru_id' => $this->guru->id]);

        $response = $this->actingAs($this->guru)->putJson("/guru/konseling/{$group->id}", [
            'nama' => 'Nama Grup Updated',
        ]);

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        $this->assertDatabaseHas('konseling_groups', [
            'id' => $group->id,
            'nama' => 'Nama Grup Updated',
        ]);
    }

    public function test_guru_can_delete_group(): void
    {
        $group = KonselingGroup::factory()->create(['guru_id' => $this->guru->id]);

        $response = $this->actingAs($this->guru)->deleteJson("/guru/konseling/{$group->id}");

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        $this->assertDatabaseMissing('konseling_groups', ['id' => $group->id]);
    }

    public function test_guru_can_approve_member(): void
    {
        $group = KonselingGroup::factory()->create(['guru_id' => $this->guru->id]);
        $siswa = User::factory()->create(['role' => 'siswa']);
        $member = KonselingMember::create([
            'group_id' => $group->id,
            'siswa_id' => $siswa->id,
            'status' => 'pending',
        ]);

        $response = $this->actingAs($this->guru)->postJson("/guru/konseling/{$group->id}/members/{$member->id}/approve");

        $response->assertStatus(200);

        $this->assertDatabaseHas('konseling_members', [
            'id' => $member->id,
            'status' => 'approved',
        ]);
    }

    public function test_guru_can_reject_member(): void
    {
        $group = KonselingGroup::factory()->create(['guru_id' => $this->guru->id]);
        $siswa = User::factory()->create(['role' => 'siswa']);
        $member = KonselingMember::create([
            'group_id' => $group->id,
            'siswa_id' => $siswa->id,
            'status' => 'pending',
        ]);

        $response = $this->actingAs($this->guru)->postJson("/guru/konseling/{$group->id}/members/{$member->id}/reject");

        $response->assertStatus(200);

        $this->assertDatabaseHas('konseling_members', [
            'id' => $member->id,
            'status' => 'rejected',
        ]);
    }

    public function test_siswa_cannot_create_group(): void
    {
        $siswa = User::factory()->create(['role' => 'siswa']);

        $response = $this->actingAs($siswa)->postJson('/guru/konseling', [
            'nama' => 'Grup Ilegal',
            'kuota' => 10,
        ]);

        $response->assertStatus(403);
    }

    public function test_guru_cannot_manage_other_gurus_group(): void
    {
        $otherGuru = User::factory()->guru()->create();
        Guru::create(['user_id' => $otherGuru->id, 'nip' => '999999']);
        $group = KonselingGroup::factory()->create(['guru_id' => $otherGuru->id]);

        $response = $this->actingAs($this->guru)->putJson("/guru/konseling/{$group->id}", [
            'nama' => 'Hacked Name',
        ]);

        $response->assertStatus(403);
    }
}
