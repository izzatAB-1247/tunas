<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\KonselingAttendance;
use App\Models\KonselingSession;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class KonselingAttendanceController extends Controller
{
    public function index(KonselingSession $session): JsonResponse
    {
        $group = $session->group;

        if ($group->guru_id !== request()->user()->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized.'], 403);
        }

        $session->load('attendance.siswa');

        return response()->json([
            'success' => true,
            'attendance' => $session->attendance,
        ]);
    }

    public function store(Request $request, KonselingSession $session): JsonResponse
    {
        $group = $session->group;

        if ($group->guru_id !== $request->user()->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized.'], 403);
        }

        $data = $request->validate([
            'attendance' => 'required|array',
            'attendance.*.siswa_id' => 'required|exists:users,id',
            'attendance.*.status' => 'required|in:hadir,izin,sakit,alpha',
            'attendance.*.keterangan' => 'nullable|string|max:255',
        ]);

        foreach ($data['attendance'] as $entry) {
            KonselingAttendance::updateOrCreate(
                [
                    'session_id' => $session->id,
                    'siswa_id' => $entry['siswa_id'],
                ],
                [
                    'status' => $entry['status'],
                    'keterangan' => $entry['keterangan'] ?? null,
                ],
            );
        }

        return response()->json([
            'success' => true,
            'message' => 'Presensi berhasil disimpan.',
        ]);
    }
}
