<?php

namespace Tests\Feature\Guru;

use App\Models\Guru;
use App\Models\User;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VideoTest extends TestCase
{
    use RefreshDatabase;

    private User $guru;

    protected function setUp(): void
    {
        parent::setUp();

        $this->guru = User::factory()->guru()->create();
        Guru::create(['user_id' => $this->guru->id, 'nip' => '123456']);
    }

    public function test_index_returns_videos_by_tipe(): void
    {
        Video::create([
            'judul' => 'Video 1',
            'kategori' => 'kategori',
            'youtube_id' => 'abc123',
            'tipe' => 'bisindo',
        ]);

        Video::create([
            'judul' => 'Video 2',
            'kategori' => 'kategori',
            'youtube_id' => 'def456',
            'tipe' => 'pelatihan',
        ]);

        $response = $this->actingAs($this->guru)->getJson('/videos?tipe=bisindo');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'total' => 1,
            ]);
    }

    public function test_guru_can_create_video(): void
    {
        $response = $this->actingAs($this->guru)->postJson('/guru/videos', [
            'judul' => 'Video Baru',
            'kategori' => 'Tutorial',
            'deskripsi' => 'Deskripsi video',
            'youtube_id' => 'xyz789',
            'tipe' => 'bisindo',
        ]);

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        $this->assertDatabaseHas('videos', [
            'judul' => 'Video Baru',
            'youtube_id' => 'xyz789',
        ]);
    }

    public function test_guru_can_delete_video(): void
    {
        $video = Video::create([
            'judul' => 'To Delete',
            'kategori' => 'Tutorial',
            'youtube_id' => 'del123',
            'tipe' => 'bisindo',
        ]);

        $response = $this->actingAs($this->guru)->deleteJson("/guru/videos/{$video->id}");

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        $this->assertDatabaseMissing('videos', ['id' => $video->id]);
    }

    public function test_siswa_cannot_create_video(): void
    {
        $siswa = User::factory()->create(['role' => 'siswa']);

        $response = $this->actingAs($siswa)->postJson('/guru/videos', [
            'judul' => 'Video Baru',
            'kategori' => 'Tutorial',
            'youtube_id' => 'xyz789',
            'tipe' => 'bisindo',
        ]);

        $response->assertStatus(403);
    }
}
