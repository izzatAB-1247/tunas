<?php

namespace Tests\Feature\Guru;

use App\Models\Guru;
use App\Models\KonselingGroup;
use App\Models\KonselingSession;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KonselingSessionTest extends TestCase
{
    use RefreshDatabase;

    private User $guru;

    private KonselingGroup $group;

    protected function setUp(): void
    {
        parent::setUp();

        $this->guru = User::factory()->guru()->create();
        Guru::create(['user_id' => $this->guru->id, 'nip' => '123456']);

        $this->group = KonselingGroup::factory()->create(['guru_id' => $this->guru->id]);
    }

    public function test_guru_can_create_session(): void
    {
        $response = $this->actingAs($this->guru)->postJson("/guru/konseling/{$this->group->id}/sessions", [
            'judul' => 'Sesi Pertemuan 1',
            'deskripsi' => 'Pembahasan karier',
            'tanggal' => '2026-07-15',
            'waktu_mulai' => '09:00',
            'waktu_selesai' => '10:00',
            'tempat' => 'Ruang A',
        ]);

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        $this->assertDatabaseHas('konseling_sessions', [
            'judul' => 'Sesi Pertemuan 1',
            'group_id' => $this->group->id,
        ]);
    }

    public function test_guru_can_list_sessions(): void
    {
        KonselingSession::create([
            'group_id' => $this->group->id,
            'judul' => 'Sesi 1',
            'tanggal' => '2026-07-15',
        ]);

        $response = $this->actingAs($this->guru)->getJson("/guru/konseling/{$this->group->id}/sessions");

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        $this->assertCount(1, $response->json('sessions'));
    }

    public function test_guru_can_delete_session(): void
    {
        $session = KonselingSession::create([
            'group_id' => $this->group->id,
            'judul' => 'To Delete',
            'tanggal' => '2026-07-15',
        ]);

        $response = $this->actingAs($this->guru)->deleteJson("/guru/konseling/{$this->group->id}/sessions/{$session->id}");

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        $this->assertDatabaseMissing('konseling_sessions', ['id' => $session->id]);
    }
}
