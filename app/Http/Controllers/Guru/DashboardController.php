<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Kuis;
use App\Models\LogLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $page = $request->query('page', 'beranda');

        $user = $request->user();
        $totalLoginSiswa = LogLogin::count();
        $rataNilai = Kuis::avg(DB::raw('CAST(jawaban_benar AS DECIMAL)'));

        return view('guru.dashboard', compact('page', 'user', 'totalLoginSiswa', 'rataNilai'));
    }
}
