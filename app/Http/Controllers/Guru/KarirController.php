<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Karir;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KarirController extends Controller
{
    public function index(): JsonResponse
    {
        $data = Karir::orderBy('id', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'pencapaian' => 'required|string',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data['foto'] = $request->file('foto')->store('karir', 'public');

        Karir::create($data);

        return response()->json(['success' => true]);
    }

    public function destroy(Karir $karir): JsonResponse
    {
        DB::transaction(function () use ($karir) {
            $karir->delete();
            Storage::disk('public')->delete($karir->foto);
        });

        return response()->json(['success' => true]);
    }
}
