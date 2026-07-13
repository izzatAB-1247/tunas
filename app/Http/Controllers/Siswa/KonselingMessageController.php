<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKonselingMessageRequest;
use App\Models\KonselingGroup;
use App\Models\KonselingMember;
use Illuminate\Http\JsonResponse;

class KonselingMessageController extends Controller
{
    public function index(KonselingGroup $group): JsonResponse
    {
        $siswaId = request()->user()->id;

        $isMember = KonselingMember::where('group_id', $group->id)
            ->where('siswa_id', $siswaId)
            ->where('status', 'approved')
            ->exists();

        if (! $isMember) {
            return response()->json(['success' => false, 'message' => 'Unauthorized.'], 403);
        }

        $messages = $group->messages()
            ->with('user')
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'messages' => $messages,
        ]);
    }

    public function store(StoreKonselingMessageRequest $request, KonselingGroup $group): JsonResponse
    {
        $siswaId = $request->user()->id;

        $isMember = KonselingMember::where('group_id', $group->id)
            ->where('siswa_id', $siswaId)
            ->where('status', 'approved')
            ->exists();

        if (! $isMember) {
            return response()->json(['success' => false, 'message' => 'Unauthorized.'], 403);
        }

        $message = $group->messages()->create([
            'user_id' => $siswaId,
            'pesan' => $request->validated()['pesan'],
        ]);

        $message->load('user');

        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }
}
