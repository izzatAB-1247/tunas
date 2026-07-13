<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKonselingGroupRequest;
use App\Http\Requests\UpdateKonselingGroupRequest;
use App\Models\KonselingGroup;
use App\Models\KonselingMember;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class KonselingGroupController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $groups = KonselingGroup::withCount(['approvedMembers', 'pendingMembers'])
            ->where('guru_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'groups' => $groups,
        ]);
    }

    public function store(StoreKonselingGroupRequest $request): JsonResponse
    {
        $group = KonselingGroup::create([
            ...$request->validated(),
            'guru_id' => $request->user()->id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Grup konseling berhasil dibuat.',
            'group' => $group,
        ]);
    }

    public function show(KonselingGroup $group): JsonResponse
    {
        if ($group->guru_id !== request()->user()->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized.'], 403);
        }

        $group->load(['members.siswa', 'sessions']);

        return response()->json([
            'success' => true,
            'group' => $group,
        ]);
    }

    public function update(UpdateKonselingGroupRequest $request, KonselingGroup $group): JsonResponse
    {
        if ($group->guru_id !== $request->user()->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized.'], 403);
        }

        $group->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Grup konseling berhasil diperbarui.',
            'group' => $group,
        ]);
    }

    public function destroy(KonselingGroup $group): JsonResponse
    {
        if ($group->guru_id !== request()->user()->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized.'], 403);
        }

        $group->delete();

        return response()->json(['success' => true]);
    }

    public function members(KonselingGroup $group): JsonResponse
    {
        if ($group->guru_id !== request()->user()->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized.'], 403);
        }

        $group->load(['members.siswa', 'approvedMembers.siswa', 'pendingMembers.siswa']);

        return response()->json([
            'success' => true,
            'members' => $group->members,
            'approved' => $group->approvedMembers,
            'pending' => $group->pendingMembers,
        ]);
    }

    public function approve(KonselingGroup $group, KonselingMember $member): JsonResponse
    {
        if ($group->guru_id !== request()->user()->id || $member->group_id !== $group->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized.'], 403);
        }

        $member->update([
            'status' => 'approved',
            'approved_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Anggota berhasil disetujui.',
        ]);
    }

    public function reject(KonselingGroup $group, KonselingMember $member): JsonResponse
    {
        if ($group->guru_id !== request()->user()->id || $member->group_id !== $group->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized.'], 403);
        }

        $member->update(['status' => 'rejected']);

        return response()->json([
            'success' => true,
            'message' => 'Anggota ditolak.',
        ]);
    }
}
