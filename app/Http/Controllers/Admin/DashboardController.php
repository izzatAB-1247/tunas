<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karir;
use App\Models\Kuis;
use App\Models\LogLogin;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $totalUsers = User::count();
        $totalGuru = User::where('role', 'guru')->count();
        $totalSiswa = User::where('role', 'siswa')->count();
        $totalVideos = Video::count();
        $totalKuis = Kuis::count();
        $totalKarir = Karir::count();
        $totalLogins = LogLogin::count();
        $recentUsers = User::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers', 'totalGuru', 'totalSiswa',
            'totalVideos', 'totalKuis', 'totalKarir',
            'totalLogins', 'recentUsers'
        ));
    }
}
