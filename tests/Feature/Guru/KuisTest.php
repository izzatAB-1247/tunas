<?php

namespace Tests\Feature\Guru;

use App\Models\Guru;
use App\Models\Kuis;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KuisTest extends TestCase
{
    use RefreshDatabase;

    private User $guru;

    protected function setUp(): void
    {
        parent::setUp();

        $this->guru = User::factory()->guru()->create();
        Guru::create(['user_id' => $this->guru->id, 'nip' => '123456']);
    }

    public function test_index_returns_kuis_by_tipe(): void
    {
        Kuis::create([
            'pertanyaan' => 'Apa ini?',
            'opsi_a' => 'A',
            'opsi_b' => 'B',
            'opsi_c' => 'C',
            'opsi_d' => 'D',
            'jawaban_benar' => 0,
            'tipe' => 'pelatihan',
        ]);

        Kuis::create([
            'pertanyaan' => 'Apa itu?',
            'opsi_a' => 'A',
            'opsi_b' => 'B',
            'opsi_c' => 'C',
            'opsi_d' => 'D',
            'jawaban_benar' => 1,
            'tipe' => 'bisindo',
        ]);

        $response = $this->actingAs($this->guru)->getJson('/kuis?tipe=pelatihan');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);

        $data = $response->json('data');
        $this->assertCount(1, $data);
        $this->assertEquals('Apa ini?', $data[0]['question']);
    }

    public function test_guru_can_create_kuis(): void
    {
        $response = $this->actingAs($this->guru)->postJson('/guru/kuis', [
            'pertanyaan' => 'Siapa presiden RI?',
            'emoji' => '😊',
            'opsi_a' => 'Jokowi',
            'opsi_b' => 'Prabowo',
            'opsi_c' => 'Megawati',
            'opsi_d' => 'SBY',
            'jawaban_benar' => 0,
            'tipe' => 'pelatihan',
        ]);

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        $this->assertDatabaseHas('kuis', [
            'pertanyaan' => 'Siapa presiden RI?',
        ]);
    }

    public function test_guru_can_delete_kuis(): void
    {
        $kuis = Kuis::create([
            'pertanyaan' => 'To Delete',
            'opsi_a' => 'A',
            'opsi_b' => 'B',
            'opsi_c' => 'C',
            'opsi_d' => 'D',
            'jawaban_benar' => 0,
            'tipe' => 'pelatihan',
        ]);

        $response = $this->actingAs($this->guru)->deleteJson("/guru/kuis/{$kuis->id}");

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        $this->assertDatabaseMissing('kuis', ['id' => $kuis->id]);
    }

    public function test_guru_cannot_create_kuis_with_invalid_data(): void
    {
        $response = $this->actingAs($this->guru)->postJson('/guru/kuis', [
            'pertanyaan' => '',
            'tipe' => 'pelatihan',
        ]);

        $response->assertStatus(422);
    }

    public function test_siswa_cannot_create_kuis(): void
    {
        $siswa = User::factory()->create(['role' => 'siswa']);

        $response = $this->actingAs($siswa)->postJson('/guru/kuis', [
            'pertanyaan' => 'Test?',
            'opsi_a' => 'A',
            'opsi_b' => 'B',
            'opsi_c' => 'C',
            'opsi_d' => 'D',
            'jawaban_benar' => 0,
            'tipe' => 'pelatihan',
        ]);

        $response->assertStatus(403);
    }
}
