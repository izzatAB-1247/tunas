<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKonselingMessageRequest;
use App\Models\KonselingGroup;
use Illuminate\Http\JsonResponse;

class KonselingMessageController extends Controller
{
    public function index(KonselingGroup $group): JsonResponse
    {
        if ($group->guru_id !== request()->user()->id) {
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
        if ($group->guru_id !== $request->user()->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized.'], 403);
        }

        $message = $group->messages()->create([
            'user_id' => $request->user()->id,
            'pesan' => $request->validated()['pesan'],
        ]);

        $message->load('user');

        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }
}
