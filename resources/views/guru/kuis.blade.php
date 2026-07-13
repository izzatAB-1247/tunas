<div class="clay-quiz-container clay-animate-fade-in">
    <div class="text-center mb-4">
        <h1 style="color:var(--color-clay-primary);font-weight:800;">🎯 Kuis Interaktif</h1>
        <p style="color:var(--color-clay-text-muted);">Kuis dengan Visualisasi Jelas untuk Semua</p>
    </div>

    <div class="text-center mb-4 d-flex gap-3 justify-content-center flex-wrap">
        <button class="clay-btn clay-btn-primary" data-bs-toggle="modal" data-bs-target="#addKuisModal"><span class="material-symbols-outlined" style="font-size:20px;">add</span> Tambah Soal</button>
        <button class="clay-btn clay-btn-soft" onclick="openManageModal()"><span class="material-symbols-outlined" style="font-size:20px;">settings</span> Kelola Soal</button>
    </div>

    <div class="d-flex justify-content-center gap-2 mb-3 flex-wrap" id="indicator"></div>
    <div style="width:100%;height:10px;background:rgba(163,155,145,0.15);border-radius:10px;overflow:hidden;margin-bottom:30px;">
        <div style="height:100%;background:linear-gradient(90deg,var(--color-clay-primary),var(--color-clay-primary-light));transition:width 0.5s ease;width:0%;border-radius:10px;" id="progress"></div>
    </div>
    <div id="quizContent"></div>
    <div class="d-flex gap-3 mt-4" id="buttons"></div>
    <div class="text-center" id="result" style="display:none;"></div>
</div>

<div class="modal fade clay-modal" id="addKuisModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content p-3">
            <div class="modal-header">
                <h3 style="font-weight:800;">Tambah Soal Kuis</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formTambahKuis">
                    <div class="mb-3">
                        <label class="fw-semibold" style="font-size:13px;">Pertanyaan</label>
                        <textarea class="clay-input" name="pertanyaan" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="fw-semibold" style="font-size:13px;">Gambar Soal (Opsional)</label>
                        <input type="file" class="clay-input" id="inputGambar" accept="image/*">
                        <div id="previewContainer" style="display:none;margin-top:10px;text-align:center;">
                            <img id="imgPreview" src="#" alt="Preview" style="max-height:150px;border-radius:14px;">
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6"><label class="fw-semibold" style="font-size:13px;">Opsi A</label><input type="text" class="clay-input" name="opsi_a" required></div>
                        <div class="col-6"><label class="fw-semibold" style="font-size:13px;">Opsi B</label><input type="text" class="clay-input" name="opsi_b" required></div>
                        <div class="col-6"><label class="fw-semibold" style="font-size:13px;">Opsi C</label><input type="text" class="clay-input" name="opsi_c" required></div>
                        <div class="col-6"><label class="fw-semibold" style="font-size:13px;">Opsi D</label><input type="text" class="clay-input" name="opsi_d" required></div>
                    </div>
                    <div class="mt-3">
                        <label class="fw-semibold" style="font-size:13px;">Jawaban Benar</label>
                        <select class="clay-select" name="jawaban_benar">
                            <option value="0">Opsi A</option>
                            <option value="1">Opsi B</option>
                            <option value="2">Opsi C</option>
                            <option value="3">Opsi D</option>
                        </select>
                    </div>
                    <button type="submit" class="clay-btn clay-btn-primary w-100 mt-4 justify-content-center">Simpan Soal</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade clay-modal" id="manageKuisModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-3">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Daftar Semua Soal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="manageList" class="d-flex flex-column gap-2"></div>
            </div>
        </div>
    </div>
</div>

<script>
let quizData = [];
let currentQuestion = 0;
let score = 0;
let selectedAnswer = null;
let answered = false;

function init() { renderIndicator(); renderQuestion(); renderButtons(); }

function renderIndicator() {
    document.getElementById('indicator').innerHTML = quizData.map((_, i) =>
        `<div class="clay-quiz-indicator ${i === currentQuestion ? 'active' : ''} ${i < currentQuestion ? 'completed' : ''}">${i + 1}</div>`
    ).join('');
}

function renderQuestion() {
    const q = quizData[currentQuestion];
    let visual = q.emoji && (q.emoji.includes('.jpg') || q.emoji.includes('.png') || q.emoji.startsWith('data:'))
        ? `<img src="${q.emoji}" style="max-width:100%;max-height:200px;border-radius:15px;object-fit:contain;">`
        : (q.emoji || '🎯');
    document.getElementById('quizContent').innerHTML = `
        <div style="text-align:center;">
            <h2 style="color:var(--color-clay-text);font-size:1.1rem;">Pertanyaan ${currentQuestion + 1} dari ${quizData.length}</h2>
            <div style="width:100%;max-width:400px;height:200px;background:var(--color-clay-warm);border-radius:14px;margin:16px auto;display:flex;align-items:center;justify-content:center;font-size:4em;box-shadow:var(--shadow-clay-inset);">${visual}</div>
            <h2 style="font-size:1.2rem;color:var(--color-clay-text);">${q.question}</h2>
        </div>
        <div class="d-grid gap-3 mt-4">${q.options.map((opt, i) =>
            `<div class="option" onclick="selectAnswer(${i})" style="padding:18px;border:3px solid rgba(163,155,145,0.2);border-radius:14px;cursor:pointer;transition:all 0.3s;display:flex;align-items:center;gap:15px;font-size:1.05rem;">
                <div style="width:32px;height:32px;border-radius:50%;background:var(--color-clay-surface);color:var(--color-clay-primary);display:flex;align-items:center;justify-content:center;font-weight:bold;box-shadow:var(--shadow-clay-sm);">${String.fromCharCode(65 + i)}</div>
                <span>${opt}</span>
            </div>`
        ).join('')}</div>
        <div class="feedback" id="feedback" style="padding:14px;border-radius:12px;margin-top:16px;font-weight:bold;display:none;"></div>`;
    updateProgress();
}

function selectAnswer(index) {
    if (answered) return;
    document.querySelectorAll('.option').forEach(o => {
        o.style.borderColor = 'rgba(163,155,145,0.2)';
        o.style.background = 'transparent';
    });
    const opts = document.querySelectorAll('.option');
    opts[index].style.borderColor = 'var(--color-clay-primary)';
    opts[index].style.background = 'rgba(107,127,215,0.08)';
    selectedAnswer = index;
}

function checkAnswer() {
    if (selectedAnswer === null) { alert('Pilih jawaban terlebih dahulu!'); return; }
    answered = true;
    const q = quizData[currentQuestion];
    const options = document.querySelectorAll('.option');
    const fb = document.getElementById('feedback');
    options[q.correct].style.borderColor = '#4caf50';
    options[q.correct].style.background = '#e8f5e9';
    if (selectedAnswer === q.correct) { score++; fb.textContent = '✅ Benar!'; fb.className = 'feedback'; fb.style.display = 'block'; fb.style.background = '#e8f5e9'; fb.style.color = '#2e7d32'; }
    else {
        options[selectedAnswer].style.borderColor = '#f44336';
        options[selectedAnswer].style.background = '#ffebee';
        fb.textContent = '❌ Salah. Jawaban: ' + q.options[q.correct]; fb.className = 'feedback'; fb.style.display = 'block'; fb.style.background = '#ffebee'; fb.style.color = '#c62828';
    }
    renderButtons();
}

function nextQuestion() {
    currentQuestion++; selectedAnswer = null; answered = false;
    if (currentQuestion < quizData.length) { renderIndicator(); renderQuestion(); renderButtons(); }
    else showResult();
}

function showResult() {
    const pct = Math.round((score / quizData.length) * 100);
    const emoji = pct >= 80 ? '🏆' : pct >= 60 ? '🎉' : pct >= 40 ? '👍' : '💪';
    const msg = pct >= 80 ? 'Luar Biasa!' : pct >= 60 ? 'Bagus Sekali!' : pct >= 40 ? 'Cukup Baik!' : 'Tetap Semangat!';
    document.getElementById('quizContent').style.display = 'none';
    document.getElementById('buttons').style.display = 'none';
    document.getElementById('result').innerHTML = `<div style="font-size:5em">${emoji}</div><h2 style="color:var(--color-clay-text);">${msg}</h2><div style="font-size:4rem;color:var(--color-clay-primary);font-weight:bold;margin:16px 0;">${score}/${quizData.length}</div><button class="clay-btn clay-btn-primary" onclick="restart()">🔄 Ulangi Kuis</button>`;
    document.getElementById('result').style.display = 'block';
    document.getElementById('indicator').style.display = 'none';
    document.querySelector('.progress-bar').style.display = 'none';
}

async function loadQuizData() {
    try {
        const res = await fetch('{{ route("kuis.index") }}?tipe=pelatihan');
        const result = await res.json();
        if (result.success && result.data.length > 0) { quizData = result.data; init(); }
        else { document.getElementById('quizContent').innerHTML = '<div style="text-align:center;padding:50px;"><span style="font-size:4em">📭</span><h3 style="color:var(--color-clay-text-muted);">Belum ada soal.</h3></div>'; }
    } catch(e) { console.error(e); }
}

function restart() { currentQuestion = 0; score = 0; selectedAnswer = null; answered = false; document.getElementById('result').style.display = 'none'; document.getElementById('quizContent').style.display = 'block'; document.getElementById('buttons').style.display = 'flex'; document.getElementById('indicator').style.display = 'flex'; document.querySelector('.progress-bar').style.display = 'block'; loadQuizData(); }
function updateProgress() { document.getElementById('progress').style.width = ((currentQuestion + 1) / quizData.length * 100) + '%'; }
function renderButtons() {
    document.getElementById('buttons').innerHTML = !answered
        ? '<button class="clay-btn clay-btn-primary flex-fill justify-content-center" onclick="checkAnswer()">✓ Cek Jawaban</button>'
        : '<button class="clay-btn clay-btn-primary flex-fill justify-content-center" onclick="nextQuestion()">' + (currentQuestion < quizData.length - 1 ? '→ Berikutnya' : '🎯 Lihat Hasil') + '</button>';
}

document.getElementById('inputGambar').addEventListener('change', function(e) {
    const reader = new FileReader();
    reader.onload = function(e) { document.getElementById('imgPreview').src = e.target.result; document.getElementById('previewContainer').style.display = 'block'; };
    reader.readAsDataURL(this.files[0]);
});

document.getElementById('formTambahKuis').addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData.entries());
    const fileInput = document.getElementById('inputGambar');
    const toBase64 = file => new Promise((resolve, reject) => { const r = new FileReader(); r.readAsDataURL(file); r.onload = () => resolve(r.result); r.onerror = reject; });
    if (fileInput.files.length > 0) data.emoji = await toBase64(fileInput.files[0]);
    data.tipe = 'pelatihan';
    const res = await fetch('{{ route("guru.kuis.store") }}', {
        method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' }, body: JSON.stringify(data)
    });
    const result = await res.json();
    if (result.success) { alert('Soal berhasil disimpan!'); bootstrap.Modal.getInstance(document.getElementById('addKuisModal')).hide(); e.target.reset(); document.getElementById('previewContainer').style.display = 'none'; loadQuizData(); }
    else alert('Gagal.');
});

function openManageModal() {
    const list = document.getElementById('manageList');
    if (quizData.length === 0) { list.innerHTML = '<p class="text-center" style="color:var(--color-clay-text-muted);">Belum ada soal.</p>'; }
    else {
        list.innerHTML = quizData.map((q, i) => {
            let vis = q.emoji && (q.emoji.startsWith('data:image') || q.emoji.length > 50)
                ? `<img src="${q.emoji}" style="width:50px;height:50px;object-fit:cover;border-radius:10px;">`
                : `<span style="font-size:24px;">${q.emoji || '🎯'}</span>`;
            return `<div class="list-group-item d-flex justify-content-between align-items-center p-3"><div class="d-flex align-items-center gap-3"><div>${vis}</div><div><div class="fw-bold" style="color:var(--color-clay-text);">Soal #${i+1}</div><small style="color:var(--color-clay-text-muted);">${q.question.substring(0,50)}...</small></div></div><button onclick="hapusData(${q.id}, 'kuis')" class="clay-btn clay-btn-danger" style="padding:8px 14px;"><span class="material-symbols-outlined" style="font-size:20px;">delete</span></button></div>`;
        }).join('');
    }
    new bootstrap.Modal(document.getElementById('manageKuisModal')).show();
}

async function hapusData(id, tabel) {
    if (!confirm('Hapus?')) return;
    const res = await fetch('{{ route("guru.delete") }}', {
        method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' }, body: JSON.stringify({ id, tabel })
    });
    const result = await res.json();
    if (result.success) { alert('Terhapus!'); const modal = bootstrap.Modal.getInstance(document.getElementById('manageKuisModal')); if(modal) modal.hide(); loadQuizData(); }
}

loadQuizData();
</script>
