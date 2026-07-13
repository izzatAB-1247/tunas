<?php

namespace Tests\Feature\Guru;

use App\Models\Guru;
use App\Models\Karir;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class KarirTest extends TestCase
{
    use RefreshDatabase;

    private User $guru;

    protected function setUp(): void
    {
        parent::setUp();

        $this->guru = User::factory()->guru()->create();
        Guru::create(['user_id' => $this->guru->id, 'nip' => '123456']);
    }

    public function test_index_returns_all_karir(): void
    {
        Karir::create([
            'nama' => 'John Doe',
            'jabatan' => 'Manager',
            'deskripsi' => 'Deskripsi',
            'pencapaian' => 'Pencapaian',
            'foto' => 'karir/test.jpg',
        ]);

        $response = $this->actingAs($this->guru)->getJson('/karir');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);

        $this->assertCount(1, $response->json('data'));
    }

    public function test_guru_can_create_karir(): void
    {
        $file = UploadedFile::fake()->image('foto.jpg');

        $response = $this->actingAs($this->guru)->postJson('/guru/karir', [
            'nama' => 'Jane Doe',
            'jabatan' => 'Supervisor',
            'deskripsi' => 'Deskripsi karir',
            'pencapaian' => 'Pencapaian karir',
            'foto' => $file,
        ]);

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        $this->assertDatabaseHas('karir', [
            'nama' => 'Jane Doe',
        ]);
    }

    public function test_guru_can_delete_karir(): void
    {
        $file = UploadedFile::fake()->image('delete.jpg');
        $path = $file->store('karir', 'public');

        $karir = Karir::create([
            'nama' => 'To Delete',
            'jabatan' => 'Staff',
            'deskripsi' => 'Test',
            'pencapaian' => 'Test',
            'foto' => $path,
        ]);

        $response = $this->actingAs($this->guru)->deleteJson("/guru/karir/{$karir->id}");

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        $this->assertDatabaseMissing('karir', ['id' => $karir->id]);
        $this->assertFalse(Storage::disk('public')->exists($path));
    }

    public function test_siswa_cannot_create_karir(): void
    {
        $siswa = User::factory()->create(['role' => 'siswa']);

        $response = $this->actingAs($siswa)->postJson('/guru/karir', [
            'nama' => 'Test',
            'jabatan' => 'Test',
            'deskripsi' => 'Test',
            'pencapaian' => 'Test',
            'foto' => UploadedFile::fake()->image('test.jpg'),
        ]);

        $response->assertStatus(403);
    }
}
