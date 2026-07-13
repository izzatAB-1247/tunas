<div class="welcome-box mb-4 p-4" style="background: linear-gradient(135deg, #6366f1, #a855f7); color: white; border-radius: 25px; box-shadow: 0 10px 20px rgba(99, 102, 241, 0.2);">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h2 class="fw-bold">Halo, <?= $_SESSION['nama'] ?>! 🚀✨</h2>
            <p class="mb-0">Kamu sudah melakukan pekerjaan luar biasa hari ini. Ayo selesaikan misimu!</p>
        </div>
        <div class="col-md-4 text-end d-none d-md-block">
            <span style="font-size: 50px;">🏆</span>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="stat-card p-4" style="background: white; border-radius: 20px; border: none; box-shadow: 0 8px 15px rgba(0,0,0,0.05); transition: transform 0.3s;">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted mb-1 fw-bold">Nilai Kuis</p>
                    <h3 class="fw-bold text-primary">85/100</h3>
                </div>
                <div style="background: #eef2ff; padding: 10px; border-radius: 12px; font-size: 24px;">🎯</div>
            </div>
            <div class="progress mt-3" style="height: 8px; border-radius: 10px;">
                <div class="progress-bar bg-primary" style="width: 85%"></div>
            </div>
            <small class="text-muted mt-2 d-block">Meningkat 5% dari minggu lalu</small>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card p-4" style="background: white; border-radius: 20px; border: none; box-shadow: 0 8px 15px rgba(0,0,0,0.05);">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted mb-1 fw-bold">Materi Selesai</p>
                    <h3 class="fw-bold text-success">8 <span style="font-size: 16px; color: #94a3b8;">/ 12</span></h3>
                </div>
                <div style="background: #f0fdf4; padding: 10px; border-radius: 12px; font-size: 24px;">📚</div>
            </div>
            <div class="progress mt-3" style="height: 8px; border-radius: 10px;">
                <div class="progress-bar bg-success" style="width: 66%"></div>
            </div>
            <small class="text-muted mt-2 d-block">4 Materi lagi menuju sertifikat!</small>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card p-4" style="background: white; border-radius: 20px; border: none; box-shadow: 0 8px 15px rgba(0,0,0,0.05);">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted mb-1 fw-bold">Total Poin</p>
                    <h3 class="fw-bold text-warning">1,250</h3>
                </div>
                <div style="background: #fffbeb; padding: 10px; border-radius: 12px; font-size: 24px;">💎</div>
            </div>
            <div class="mt-3">
                <span class="badge bg-warning text-dark rounded-pill">🔥 5 Day Streak</span>
            </div>
            <small class="text-muted mt-2 d-block">Login setiap hari untuk poin ekstra!</small>
        </div>
    </div>
</div>

<div class="mt-5 p-4" style="background:white; border-radius:25px; box-shadow:0 8px 30px rgba(0,0,0,0.04);">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">📈 Progres Belajarmu</h4>
            <p class="text-muted small">Aktivitas belajar selama 7 hari terakhir</p>
        </div>
        <button class="btn btn-outline-primary btn-sm rounded-pill px-3">Lihat Detail</button>
    </div>
    <canvas id="cuteChart" height="100"></canvas>
</div>