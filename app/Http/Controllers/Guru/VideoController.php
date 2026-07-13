<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $tipe = $request->query('tipe', 'bisindo');

        $videos = Video::where('tipe', $tipe)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'videos' => $videos,
            'total' => $videos->count(),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'url' => 'nullable|string',
            'youtube_id' => 'required|string|max:50',
            'tipe' => 'required|in:pelatihan,bisindo,kosa_kata',
        ]);

        $video = Video::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil ditambahkan.',
            'id' => $video->id,
        ]);
    }

    public function destroy(Video $video): JsonResponse
    {
        $video->delete();

        return response()->json(['success' => true]);
    }
}
