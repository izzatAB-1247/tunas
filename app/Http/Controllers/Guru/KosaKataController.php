<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\JsonResponse;

class KosaKataController extends Controller
{
    public function index(): JsonResponse
    {
        $videos = Video::where('tipe', 'kosa_kata')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'videos' => $videos,
        ]);
    }
}
