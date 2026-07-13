<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Guru\DashboardController as GuruDashboardController;
use App\Http\Controllers\Guru\DeleteController;
use App\Http\Controllers\Guru\KarirController;
use App\Http\Controllers\Guru\KonselingAttendanceController;
use App\Http\Controllers\Guru\KonselingGroupController;
use App\Http\Controllers\Guru\KonselingMessageController as GuruKonselingMessageController;
use App\Http\Controllers\Guru\KonselingReportController;
use App\Http\Controllers\Guru\KonselingSessionController;
use App\Http\Controllers\Guru\KosaKataController;
use App\Http\Controllers\Guru\KuisController;
use App\Http\Controllers\Guru\ProfileController;
use App\Http\Controllers\Guru\VideoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboardController;
use App\Http\Controllers\Siswa\KonselingController as SiswaKonselingController;
use App\Http\Controllers\Siswa\KonselingMessageController as SiswaKonselingMessageController;
use App\Http\Controllers\Siswa\ProfileController as SiswaProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {

    // API Read — bisa diakses semua role (guru, siswa, admin)
    Route::get('/videos', [VideoController::class, 'index'])->name('videos.index');
    Route::get('/kuis', [KuisController::class, 'index'])->name('kuis.index');
    Route::get('/karir', [KarirController::class, 'index'])->name('karir.index');
    Route::get('/kosa-kata', [KosaKataController::class, 'index'])->name('kosa-kata.index');

    // Admin
    Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
        Route::get('/dashboard', AdminDashboardController::class)->name('dashboard');
    });

    // Guru — write operations + dashboard
    Route::prefix('guru')->name('guru.')->middleware('role:guru')->group(function () {
        Route::get('/dashboard', GuruDashboardController::class)->name('dashboard');
        Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('/delete', DeleteController::class)->name('delete');

        Route::post('/videos', [VideoController::class, 'store'])->name('videos.store');
        Route::delete('/videos/{video}', [VideoController::class, 'destroy'])->name('videos.destroy');

        Route::post('/kuis', [KuisController::class, 'store'])->name('kuis.store');
        Route::delete('/kuis/{kuis}', [KuisController::class, 'destroy'])->name('kuis.destroy');

        Route::post('/karir', [KarirController::class, 'store'])->name('karir.store');
        Route::delete('/karir/{karir}', [KarirController::class, 'destroy'])->name('karir.destroy');

        // Konseling Group Management
        Route::get('/konseling', [KonselingGroupController::class, 'index'])->name('konseling.index');
        Route::post('/konseling', [KonselingGroupController::class, 'store'])->name('konseling.store');
        Route::get('/konseling/{group}', [KonselingGroupController::class, 'show'])->name('konseling.show');
        Route::put('/konseling/{group}', [KonselingGroupController::class, 'update'])->name('konseling.update');
        Route::delete('/konseling/{group}', [KonselingGroupController::class, 'destroy'])->name('konseling.destroy');
        Route::get('/konseling/{group}/members', [KonselingGroupController::class, 'members'])->name('konseling.members');
        Route::post('/konseling/{group}/members/{member}/approve', [KonselingGroupController::class, 'approve'])->name('konseling.approve');
        Route::post('/konseling/{group}/members/{member}/reject', [KonselingGroupController::class, 'reject'])->name('konseling.reject');

        // Sessions
        Route::get('/konseling/{group}/sessions', [KonselingSessionController::class, 'index'])->name('konseling.sessions.index');
        Route::post('/konseling/{group}/sessions', [KonselingSessionController::class, 'store'])->name('konseling.sessions.store');
        Route::put('/konseling/{group}/sessions/{session}', [KonselingSessionController::class, 'update'])->name('konseling.sessions.update');
        Route::delete('/konseling/{group}/sessions/{session}', [KonselingSessionController::class, 'destroy'])->name('konseling.sessions.destroy');

        // Attendance
        Route::get('/konseling/sessions/{session}/attendance', [KonselingAttendanceController::class, 'index'])->name('konseling.attendance');
        Route::post('/konseling/sessions/{session}/attendance', [KonselingAttendanceController::class, 'store'])->name('konseling.attendance.store');

        // Reports
        Route::get('/konseling/sessions/{session}/reports', [KonselingReportController::class, 'index'])->name('konseling.reports');
        Route::post('/konseling/sessions/{session}/reports', [KonselingReportController::class, 'store'])->name('konseling.reports.store');

        // Messages
        Route::get('/konseling/{group}/messages', [GuruKonselingMessageController::class, 'index'])->name('konseling.messages');
        Route::post('/konseling/{group}/messages', [GuruKonselingMessageController::class, 'store'])->name('konseling.messages.store');
    });

    // Siswa — dashboard
    Route::prefix('siswa')->name('siswa.')->middleware('role:siswa')->group(function () {
        Route::get('/dashboard', SiswaDashboardController::class)->name('dashboard');
        Route::post('/profile', [SiswaProfileController::class, 'update'])->name('profile.update');

        // Konseling
        Route::get('/konseling', [SiswaKonselingController::class, 'index'])->name('konseling.index');
        Route::get('/konseling/{group}', [SiswaKonselingController::class, 'show'])->name('konseling.show');
        Route::post('/konseling/{group}/join', [SiswaKonselingController::class, 'join'])->name('konseling.join');
        Route::post('/konseling/{group}/leave', [SiswaKonselingController::class, 'leave'])->name('konseling.leave');
        Route::get('/konseling/{group}/sessions', [SiswaKonselingController::class, 'sessions'])->name('konseling.sessions');

        // Messages
        Route::get('/konseling/{group}/messages', [SiswaKonselingMessageController::class, 'index'])->name('konseling.messages');
        Route::post('/konseling/{group}/messages', [SiswaKonselingMessageController::class, 'store'])->name('konseling.messages.store');
    });
});
