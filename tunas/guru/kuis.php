<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuis Interaktif - Aksesibilitas Tunarungu</title>
    <link rel="stylesheet" href="/tunas/guru/css/style.css">

    <style>
      

        .container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            max-width: 700px;
            width: 100%;
            padding: 40px;
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #667eea;
            font-size: 2em;
            margin-bottom: 10px;
        }

        .visual-indicator {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .indicator-item {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .indicator-item.active {
            background: #667eea;
            color: white;
            transform: scale(1.2);
        }

        .indicator-item.completed {
            background: #4caf50;
            color: white;
        }

        .progress-bar {
            width: 100%;
            height: 10px;
            background: #e0e0e0;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 30px;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transition: width 0.5s ease;
            width: 0%;
        }

        .quiz-content {
            min-height: 300px;
        }

        .question {
            margin-bottom: 30px;
        }

        .question h2 {
            color: #333;
            font-size: 1.5em;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .question-image {
            width: 100%;
            max-width: 400px;
            height: 200px;
            background: #f5f5f5;
            border-radius: 10px;
            margin: 20px auto;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4em;
        }

        .options {
            display: grid;
            gap: 15px;
            margin-top: 20px;
        }

        .option {
            padding: 20px;
            border: 3px solid #e0e0e0;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 1.1em;
        }

        .option:hover {
            border-color: #667eea;
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.2);
        }

        .option.selected {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }

        .option.correct {
            background: #4caf50;
            color: white;
            border-color: #4caf50;
        }

        .option.incorrect {
            background: #f44336;
            color: white;
            border-color: #f44336;
        }

        .option-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: white;
            color: #667eea;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            flex-shrink: 0;
        }

        .option.selected .option-icon {
            background: white;
            color: #667eea;
        }

        .buttons {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        button {
            flex: 1;
            padding: 15px 30px;
            border: none;
            border-radius: 10px;
            font-size: 1.1em;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: bold;
        }

        .btn-primary {
            background: #667eea;
            color: white;
        }

        .btn-primary:hover {
            background: #5568d3;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-secondary {
            background: #e0e0e0;
            color: #333;
        }

        .btn-secondary:hover {
            background: #d0d0d0;
        }

        button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .result {
            text-align: center;
            display: none;
        }

        .result.show {
            display: block;
            animation: slideIn 0.5s ease-out;
        }

        .result-score {
            font-size: 5em;
            color: #667eea;
            margin: 20px 0;
            font-weight: bold;
        }

        .result h2 {
            color: #333;
            font-size: 2em;
            margin-bottom: 20px;
        }

        .result-message {
            font-size: 1.2em;
            color: #666;
            margin-bottom: 30px;
        }

        .emoji {
            font-size: 5em;
            margin: 20px 0;
        }

        .feedback {
            padding: 15px;
            border-radius: 10px;
            margin-top: 15px;
            font-weight: bold;
            display: none;
        }

        .feedback.show {
            display: block;
            animation: slideIn 0.3s ease-out;
        }

        .feedback.correct {
            background: #e8f5e9;
            color: #2e7d32;
            border: 2px solid #4caf50;
        }

        .feedback.incorrect {
            background: #ffebee;
            color: #c62828;
            border: 2px solid #f44336;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎯 Kuis Interaktif</h1>
            <p>Kuis dengan Visualisasi Jelas untuk Semua</p>
        </div>
      <div class="admin-controls" style="text-align: center; margin-bottom: 20px;">
    <button class="btn-primary" data-bs-toggle="modal" data-bs-target="#addKuisModal">➕ Tambah Soal</button>
    <button class="btn-primary" style="background: #6c757d;" onclick="openManageModal()">⚙️ Kelola Semua Soal</button>
</div>

        <div class="visual-indicator" id="indicator"></div>
        
        <div class="progress-bar">
            <div class="progress-fill" id="progress"></div>
        </div>

        <div class="quiz-content" id="quizContent"></div>

        <div class="buttons" id="buttons"></div>

        <div class="result" id="result"></div>
    </div>
<div class="modal fade" id="addKuisModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="padding: 20px; border-radius: 15px;">
            <h3>Tambah Soal Kuis</h3>
            <form id="formTambahKuis">
                <div class="mb-3">
                    <label>Pertanyaan</label>
                    <textarea class="form-control" name="pertanyaan" required></textarea>
                </div>
              <div class="mb-3">
    <label>Gambar Soal (Opsional)</label>
    <input type="file" class="form-control" name="gambar_soal" id="inputGambar" accept="image/*">
    <div id="previewContainer" style="display:none; margin-top: 10px; text-align: center;">
        <img id="imgPreview" src="#" alt="Preview" style="max-height: 150px; border-radius: 10px;">
    </div>
</div>
                <div class="row">
                    <div class="col-6"><label>Opsi A</label><input type="text" class="form-control" name="opsi_a" required></div>
                    <div class="col-6"><label>Opsi B</label><input type="text" class="form-control" name="opsi_b" required></div>
                </div>
                <div class="row mt-2">
                    <div class="col-6"><label>Opsi C</label><input type="text" class="form-control" name="opsi_c" required></div>
                    <div class="col-6"><label>Opsi D</label><input type="text" class="form-control" name="opsi_d" required></div>
                </div>
                <div class="mb-3 mt-3">
                    <label>Jawaban Benar</label>
                    <select class="form-control" name="jawaban_benar">
                        <option value="0">Opsi A</option>
                        <option value="1">Opsi B</option>
                        <option value="2">Opsi C</option>
                        <option value="3">Opsi D</option>
                    </select>
                </div>
                <button type="submit" class="btn-primary w-100">Simpan Soal</button>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="manageKuisModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 20px; padding: 20px;">
            <div class="modal-header">
                <h5 class="modal-title">Daftar Semua Soal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="manageList" class="list-group">
                    </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
       let quizData = [];

        let currentQuestion = 0;
        let score = 0;
        let selectedAnswer = null;
        let answered = false;

        function init() {
            renderIndicator();
            renderQuestion();
            renderButtons();
        }

        function renderIndicator() {
            const indicator = document.getElementById('indicator');
            indicator.innerHTML = quizData.map((_, i) => {
                let className = 'indicator-item';
                if (i === currentQuestion) className += ' active';
                if (i < currentQuestion) className += ' completed';
                return `<div class="${className}">${i + 1}</div>`;
            }).join('');
        }

      function renderQuestion() {
    const content = document.getElementById('quizContent');
    const q = quizData[currentQuestion];
    
    // Logika deteksi Gambar vs Emoji
    let visualElement = '';
    if (q.emoji && (q.emoji.includes('.jpg') || q.emoji.includes('.png') || q.emoji.includes('.jpeg') || q.emoji.startsWith('data:'))) {
        visualElement = `<img src="${q.emoji}" style="max-width: 100%; max-height: 200px; border-radius: 15px; object-fit: contain;">`;
    } else {
        visualElement = q.emoji || '🎯'; // Default emoji jika kosong
    }

    content.innerHTML = `
        <div class="question">
            <h2>
                <span>Pertanyaan ${currentQuestion + 1} dari ${quizData.length}</span>
            </h2>
            <div class="question-image">${visualElement}</div>
            <h2 style="font-size: 1.3em; text-align: center;">${q.question}</h2>
        </div>
        <div class="options">
            ${q.options.map((opt, i) => `
                <div class="option" onclick="selectAnswer(${i})">
                    <div class="option-icon">${String.fromCharCode(65 + i)}</div>
                    <span>${opt}</span>
                </div>
            `).join('')}
        </div>
        <div class="feedback" id="feedback"></div>
    `;

    updateProgress();
}

        function selectAnswer(index) {
            if (answered) return;

            const options = document.querySelectorAll('.option');
            options.forEach(opt => opt.classList.remove('selected'));
            options[index].classList.add('selected');
            selectedAnswer = index;
        }

        function checkAnswer() {
            if (selectedAnswer === null) {
                alert('⚠️ Silakan pilih jawaban terlebih dahulu!');
                return;
            }

            answered = true;
            const q = quizData[currentQuestion];
            const options = document.querySelectorAll('.option');
            const feedback = document.getElementById('feedback');

            options[q.correct].classList.add('correct');
            
            if (selectedAnswer === q.correct) {
                score++;
                feedback.textContent = '✅ Jawaban Benar! Hebat!';
                feedback.className = 'feedback correct show';
            } else {
                options[selectedAnswer].classList.add('incorrect');
                feedback.textContent = `❌ Jawaban Salah. Jawaban yang benar adalah: ${q.options[q.correct]}`;
                feedback.className = 'feedback incorrect show';
            }

            renderButtons();
        }

        function nextQuestion() {
            currentQuestion++;
            selectedAnswer = null;
            answered = false;

            if (currentQuestion < quizData.length) {
                renderIndicator();
                renderQuestion();
                renderButtons();
            } else {
                showResult();
            }
        }

        function showResult() {
            const content = document.getElementById('quizContent');
            const buttons = document.getElementById('buttons');
            const result = document.getElementById('result');
            const percentage = Math.round((score / quizData.length) * 100);

            let emoji, message;
            if (percentage >= 80) {
                emoji = '🏆';
                message = 'Luar Biasa!';
            } else if (percentage >= 60) {
                emoji = '🎉';
                message = 'Bagus Sekali!';
            } else if (percentage >= 40) {
                emoji = '👍';
                message = 'Cukup Baik!';
            } else {
                emoji = '💪';
                message = 'Tetap Semangat!';
            }

            content.style.display = 'none';
            buttons.style.display = 'none';
            result.innerHTML = `
                <div class="emoji">${emoji}</div>
                <h2>${message}</h2>
                <div class="result-score">${score}/${quizData.length}</div>
                <div class="result-message">
                    Anda menjawab ${score} dari ${quizData.length} pertanyaan dengan benar<br>
                    (${percentage}%)
                </div>
                <button class="btn-primary" onclick="restart()">🔄 Ulangi Kuis</button>
            `;
            result.classList.add('show');

            document.querySelector('.visual-indicator').style.display = 'none';
            document.querySelector('.progress-bar').style.display = 'none';
        }
async function loadQuizData() {
    try {
        // Mengambil kuis berdasarkan tipe (misal: pelatihan)
        const response = await fetch('get_kuis.php?tipe=pelatihan');
        const result = await response.json();
        
        if (result.success && result.data.length > 0) {
            quizData = result.data; // Isi array quizData dengan data dari DB
            init(); // Jalankan kuis setelah data siap
        } else {
            document.getElementById('quizContent').innerHTML = `
                <div style="text-align:center; padding: 50px;">
                    <span style="font-size: 4em;">📭</span>
                    <h3>Belum ada soal kuis tersedia untuk kategori ini.</h3>
                </div>`;
        }
    } catch (error) {
        console.error("Gagal memuat kuis:", error);
        alert("Gagal mengambil data kuis dari server.");
    }
}
        function restart() {
            currentQuestion = 0;
            score = 0;
            selectedAnswer = null;
            answered = false;

            document.getElementById('result').classList.remove('show');
            document.getElementById('quizContent').style.display = 'block';
            document.getElementById('buttons').style.display = 'flex';
            document.querySelector('.visual-indicator').style.display = 'flex';
            document.querySelector('.progress-bar').style.display = 'block';

        loadQuizData();
        }

        function updateProgress() {
            const progress = document.getElementById('progress');
            const percentage = ((currentQuestion + 1) / quizData.length) * 100;
            progress.style.width = percentage + '%';
        }

        function renderButtons() {
            const buttons = document.getElementById('buttons');
            
            if (!answered) {
                buttons.innerHTML = `
                    <button class="btn-primary" onclick="checkAnswer()">✓ Cek Jawaban</button>
                `;
            } else {
                buttons.innerHTML = `
                    <button class="btn-primary" onclick="nextQuestion()">
                        ${currentQuestion < quizData.length - 1 ? '→ Pertanyaan Berikutnya' : '🎯 Lihat Hasil'}
                    </button>
                `;
            }
        }

     loadQuizData();
   // Preview Gambar saat dipilih
document.getElementById('inputGambar').addEventListener('change', function(e) {
    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('imgPreview').src = e.target.result;
        document.getElementById('previewContainer').style.display = 'block';
    }
    reader.readAsDataURL(this.files[0]);
});

// Update listener Submit Form
document.getElementById('formTambahKuis').addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData.entries());
    
    const fileInput = document.getElementById('inputGambar');
    
    // Fungsi untuk memproses file jadi Base64
    const toBase64 = file => new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
    });

    if (fileInput.files.length > 0) {
        data.emoji = await toBase64(fileInput.files[0]); // Simpan string gambar ke field emoji
    }

    data.tipe = 'pelatihan'; 

    try {
        const response = await fetch('save_kuis.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });
        
        const res = await response.json();
        if(res.success) {
            alert("✅ Soal dengan gambar berhasil disimpan!");
            bootstrap.Modal.getInstance(document.getElementById('addKuisModal')).hide();
            e.target.reset();
            document.getElementById('previewContainer').style.display = 'none';
            loadQuizData(); 
        }
    } catch (error) {
        alert("Terjadi kesalahan.");
    }
});
// Fungsi untuk membuka modal kelola dan menampilkan daftar soal
function openManageModal() {
    const manageList = document.getElementById('manageList');
    
    if (quizData.length === 0) {
        manageList.innerHTML = '<p class="text-center">Belum ada soal tersedia.</p>';
    } else {
        manageList.innerHTML = quizData.map((q, index) => {
            // Logika untuk mendeteksi apakah 'emoji' berisi Base64 Gambar atau hanya teks/emoji
            let displayVisual = '';
            if (q.emoji && (q.emoji.startsWith('data:image') || q.emoji.length > 50)) {
                // Jika berupa string panjang (base64), tampilkan sebagai gambar kecil
                displayVisual = `<img src="${q.emoji}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px; border: 1px solid #ddd;">`;
            } else {
                // Jika hanya emoji teks biasa
                displayVisual = `<span style="font-size: 24px;">${q.emoji || '🎯'}</span>`;
            }

            return `
            <div class="list-group-item d-flex justify-content-between align-items-center" style="margin-bottom: 10px; border-radius: 12px; border: 1px solid #eee;">
                <div class="d-flex align-items-center gap-3">
                    <div class="visual-preview">
                        ${displayVisual}
                    </div>
                    <div>
                        <div class="fw-bold" style="font-size: 14px;">Soal #${index + 1}</div>
                        <small class="text-muted d-block" style="max-width: 400px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            ${q.question}
                        </small>
                    </div>
                </div>
                <button onclick="hapusData(${q.id}, 'kuis')" class="btn btn-outline-danger btn-sm rounded-circle" title="Hapus">
                    <i class="bi bi-trash"></i>
                </button>
            </div>`;
        }).join('');
    }
    
    const myModal = new bootstrap.Modal(document.getElementById('manageKuisModal'));
    myModal.show();
}

// Fungsi Hapus Data (Gunakan yang ini)
async function hapusData(id, namaTabel) {
    if (confirm("⚠️ Apakah Anda yakin ingin menghapus soal ini secara permanen?")) {
        try {
            const response = await fetch('delete.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id: id, tabel: namaTabel })
            });
            
            const res = await response.json();
            if (res.success) {
                alert("✅ Soal berhasil dihapus!");
                
                // Tutup modal kelola jika terbuka
                const modalEl = document.getElementById('manageKuisModal');
                const modalInstance = bootstrap.Modal.getInstance(modalEl);
                if(modalInstance) modalInstance.hide();
                
                // Muat ulang data kuis tanpa refresh halaman penuh
                loadQuizData(); 
            } else {
                alert("❌ Gagal menghapus: " + res.message);
            }
        } catch (error) {
            console.error("Error:", error);
            alert("Terjadi kesalahan koneksi ke server.");
        }
    }
}
    </script>
</body>
</html>