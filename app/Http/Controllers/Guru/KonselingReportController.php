<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\KonselingReport;
use App\Models\KonselingSession;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class KonselingReportController extends Controller
{
    public function index(KonselingSession $session): JsonResponse
    {
        $group = $session->group;

        if ($group->guru_id !== request()->user()->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized.'], 403);
        }

        $session->load('reports.siswa');

        return response()->json([
            'success' => true,
            'reports' => $session->reports,
        ]);
    }

    public function store(Request $request, KonselingSession $session): JsonResponse
    {
        $group = $session->group;

        if ($group->guru_id !== $request->user()->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized.'], 403);
        }

        $data = $request->validate([
            'siswa_id' => 'required|exists:users,id',
            'catatan' => 'nullable|string',
            'evaluasi' => 'nullable|string',
            'tindak_lanjut' => 'nullable|string',
        ]);

        $report = KonselingReport::updateOrCreate(
            [
                'session_id' => $session->id,
                'siswa_id' => $data['siswa_id'],
            ],
            [
                'guru_id' => $request->user()->id,
                'catatan' => $data['catatan'] ?? null,
                'evaluasi' => $data['evaluasi'] ?? null,
                'tindak_lanjut' => $data['tindak_lanjut'] ?? null,
            ],
        );

        return response()->json([
            'success' => true,
            'message' => 'Laporan konseling berhasil disimpan.',
            'report' => $report,
        ]);
    }
}
