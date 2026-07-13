<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\KonselingGroup;
use App\Models\KonselingMember;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class KonselingController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $siswaId = $request->user()->id;

        $myGroups = KonselingGroup::whereHas('members', fn ($q) => $q->where('siswa_id', $siswaId))
            ->withCount('approvedMembers')
            ->with([
                'members' => fn ($q) => $q->where('siswa_id', $siswaId),
                'guru',
            ])
            ->get();

        $myGroupIds = $myGroups->pluck('id');

        $availableGroups = KonselingGroup::where('status', 'aktif')
            ->whereNotIn('id', $myGroupIds)
            ->withCount('approvedMembers')
            ->with('guru')
            ->get()
            ->filter(fn ($g) => $g->approved_members_count < $g->kuota)
            ->values();

        return response()->json([
            'success' => true,
            'my_groups' => $myGroups,
            'available_groups' => $availableGroups,
        ]);
    }

    public function show(KonselingGroup $group): JsonResponse
    {
        $siswaId = request()->user()->id;

        $member = KonselingMember::where('group_id', $group->id)
            ->where('siswa_id', $siswaId)
            ->first();

        $group->loadCount('approvedMembers');
        $group->load('guru');

        return response()->json([
            'success' => true,
            'group' => $group,
            'membership' => $member,
        ]);
    }

    public function join(Request $request, KonselingGroup $group): JsonResponse
    {
        $siswaId = $request->user()->id;

        $existing = KonselingMember::where('group_id', $group->id)
            ->where('siswa_id', $siswaId)
            ->first();

        if ($existing) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah terdaftar di grup ini.',
            ], 422);
        }

        if ($group->approvedMembers()->count() >= $group->kuota) {
            return response()->json([
                'success' => false,
                'message' => 'Kuota grup sudah penuh.',
            ], 422);
        }

        KonselingMember::create([
            'group_id' => $group->id,
            'siswa_id' => $siswaId,
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Permintaan bergabung telah dikirim. Tunggu persetujuan guru.',
        ]);
    }

    public function leave(Request $request, KonselingGroup $group): JsonResponse
    {
        $siswaId = $request->user()->id;

        $member = KonselingMember::where('group_id', $group->id)
            ->where('siswa_id', $siswaId)
            ->first();

        if (! $member) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak terdaftar di grup ini.',
            ], 404);
        }

        $member->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil keluar dari grup.',
        ]);
    }

    public function sessions(KonselingGroup $group): JsonResponse
    {
        $siswaId = request()->user()->id;

        $member = KonselingMember::where('group_id', $group->id)
            ->where('siswa_id', $siswaId)
            ->where('status', 'approved')
            ->exists();

        if (! $member) {
            return response()->json(['success' => false, 'message' => 'Unauthorized.'], 403);
        }

        $sessions = $group->sessions()
            ->orderBy('tanggal', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'sessions' => $sessions,
        ]);
    }
}
