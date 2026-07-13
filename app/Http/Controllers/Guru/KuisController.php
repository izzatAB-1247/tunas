<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Kuis;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class KuisController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $tipe = $request->query('tipe', 'pelatihan');

        $data = Kuis::where('tipe', $tipe)
            ->orderBy('id', 'desc')
            ->get()
            ->map(fn ($q) => [
                'id' => $q->id,
                'question' => $q->pertanyaan,
                'emoji' => $q->emoji,
                'options' => [$q->opsi_a, $q->opsi_b, $q->opsi_c, $q->opsi_d],
                'correct' => $q->jawaban_benar,
            ]);

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'pertanyaan' => 'required|string',
            'emoji' => 'nullable|string',
            'opsi_a' => 'required|string',
            'opsi_b' => 'required|string',
            'opsi_c' => 'required|string',
            'opsi_d' => 'required|string',
            'jawaban_benar' => 'required|integer|between:0,3',
            'tipe' => 'required|string',
        ]);

        Kuis::create($data);

        return response()->json(['success' => true]);
    }

    public function destroy(Kuis $kuis): JsonResponse
    {
        $kuis->delete();

        return response()->json(['success' => true]);
    }
}
