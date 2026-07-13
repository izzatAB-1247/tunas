<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Karir;
use App\Models\Kuis;
use App\Models\Video;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $request->validate([
            'id' => 'required|integer',
            'tabel' => 'required|in:kuis,videos,karir',
        ]);

        $model = match ($request->tabel) {
            'videos' => Video::class,
            'kuis' => Kuis::class,
            'karir' => Karir::class,
        };

        $record = $model::find($request->id);

        if (! $record) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan.'], 404);
        }

        $record->delete();

        return response()->json(['success' => true]);
    }
}
