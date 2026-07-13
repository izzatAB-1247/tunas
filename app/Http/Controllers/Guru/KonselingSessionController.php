<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKonselingSessionRequest;
use App\Models\KonselingGroup;
use App\Models\KonselingSession;
use Illuminate\Http\JsonResponse;

class KonselingSessionController extends Controller
{
    public function index(KonselingGroup $group): JsonResponse
    {
        if ($group->guru_id !== request()->user()->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized.'], 403);
        }

        $sessions = $group->sessions()->orderBy('tanggal', 'desc')->get();

        return response()->json([
            'success' => true,
            'sessions' => $sessions,
        ]);
    }

    public function store(StoreKonselingSessionRequest $request, KonselingGroup $group): JsonResponse
    {
        if ($group->guru_id !== $request->user()->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized.'], 403);
        }

        $session = $group->sessions()->create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Sesi konseling berhasil dibuat.',
            'session' => $session,
        ]);
    }

    public function update(StoreKonselingSessionRequest $request, KonselingGroup $group, KonselingSession $session): JsonResponse
    {
        if ($group->guru_id !== $request->user()->id || $session->group_id !== $group->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized.'], 403);
        }

        $session->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Sesi konseling berhasil diperbarui.',
            'session' => $session,
        ]);
    }

    public function destroy(KonselingGroup $group, KonselingSession $session): JsonResponse
    {
        if ($group->guru_id !== request()->user()->id || $session->group_id !== $group->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized.'], 403);
        }

        $session->delete();

        return response()->json(['success' => true]);
    }
}
