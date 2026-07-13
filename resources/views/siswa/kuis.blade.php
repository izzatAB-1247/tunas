<div class="clay-quiz-container clay-animate-fade-in">
    <h1 class="text-center" style="color:var(--color-clay-primary);font-weight:800;">🎯 Kuis Interaktif</h1>
    <div class="d-flex justify-content-center gap-2 mb-3 flex-wrap" id="indicator"></div>
    <div style="width:100%;height:10px;background:rgba(163,155,145,0.15);border-radius:10px;overflow:hidden;margin-bottom:30px;">
        <div style="height:100%;background:linear-gradient(90deg,var(--color-clay-primary),var(--color-clay-primary-light));transition:width 0.5s ease;width:0%;border-radius:10px;" id="progress"></div>
    </div>
    <div id="quizContent"></div>
    <div class="d-flex gap-3 mt-4" id="buttons"></div>
    <div class="text-center" id="result" style="display:none;"></div>
</div>

<script>
let quizData = [], currentQuestion = 0, score = 0, selectedAnswer = null, answered = false;

function init() { renderIndicator(); renderQuestion(); renderButtons(); }
function renderIndicator() { document.getElementById('indicator').innerHTML = quizData.map((_,i) => `<div class="clay-quiz-indicator ${i===currentQuestion?'active':''} ${i<currentQuestion?'completed':''}">${i+1}</div>`).join(''); }
function renderQuestion() {
    const q = quizData[currentQuestion];
    let visual = q.emoji && (q.emoji.includes('.jpg')||q.emoji.includes('.png')||q.emoji.startsWith('data:')) ? `<img src="${q.emoji}" style="max-width:100%;max-height:200px;border-radius:15px;">` : (q.emoji||'🎯');
    document.getElementById('quizContent').innerHTML = `<div style="text-align:center;"><h2 style="color:var(--color-clay-text);font-size:1.1rem;">Pertanyaan ${currentQuestion+1} dari ${quizData.length}</h2><div style="width:100%;max-width:400px;height:200px;background:var(--color-clay-warm);border-radius:14px;margin:16px auto;display:flex;align-items:center;justify-content:center;font-size:4em;box-shadow:var(--shadow-clay-inset);">${visual}</div><h2 style="font-size:1.2rem;color:var(--color-clay-text);">${q.question}</h2></div><div class="d-grid gap-3 mt-3">${q.options.map((opt,i) => `<div class="option" onclick="selectAnswer(${i})" style="padding:18px;border:3px solid rgba(163,155,145,0.2);border-radius:14px;cursor:pointer;transition:all 0.3s;display:flex;align-items:center;gap:15px;"><div style="width:32px;height:32px;border-radius:50%;background:var(--color-clay-surface);color:var(--color-clay-primary);display:flex;align-items:center;justify-content:center;font-weight:bold;box-shadow:var(--shadow-clay-sm);">${String.fromCharCode(65+i)}</div><span>${opt}</span></div>`).join('')}</div><div class="feedback" id="feedback" style="padding:14px;border-radius:12px;margin-top:16px;font-weight:bold;display:none;"></div>`;
    updateProgress();
}
function selectAnswer(i) { if(answered) return; document.querySelectorAll('.option').forEach(o=>{o.style.borderColor='rgba(163,155,145,0.2)';o.style.background='transparent';}); const opts=document.querySelectorAll('.option'); opts[i].style.borderColor='var(--color-clay-primary)'; opts[i].style.background='rgba(107,127,215,0.08)'; selectedAnswer=i; }
function checkAnswer() {
    if(selectedAnswer===null){alert('Pilih jawaban!');return;}
    answered=true; const q=quizData[currentQuestion]; const opts=document.querySelectorAll('.option'); const fb=document.getElementById('feedback');
    opts[q.correct].style.borderColor='#4caf50'; opts[q.correct].style.background='#e8f5e9';
    if(selectedAnswer===q.correct){score++;fb.textContent='✅ Benar!';fb.style.display='block';fb.style.background='#e8f5e9';fb.style.color='#2e7d32';}
    else{opts[selectedAnswer].style.borderColor='#f44336';opts[selectedAnswer].style.background='#ffebee';fb.textContent='❌ Salah. Jawaban: '+q.options[q.correct];fb.style.display='block';fb.style.background='#ffebee';fb.style.color='#c62828';}
    renderButtons();
}
function nextQuestion(){currentQuestion++;selectedAnswer=null;answered=false;if(currentQuestion<quizData.length){renderIndicator();renderQuestion();renderButtons();}else showResult();}
function showResult(){const p=Math.round(score/quizData.length*100);document.getElementById('quizContent').style.display='none';document.getElementById('buttons').style.display='none';document.getElementById('result').innerHTML=`<div style="font-size:5em">${p>=80?'🏆':p>=60?'🎉':p>=40?'👍':'💪'}</div><h2 style="color:var(--color-clay-text);">${p>=80?'Luar Biasa!':p>=60?'Bagus!':p>=40?'Cukup':'Semangat!'}</h2><div style="font-size:4rem;color:var(--color-clay-primary);font-weight:bold;margin:16px 0;">${score}/${quizData.length}</div><button class="clay-btn clay-btn-primary" onclick="location.reload()">🔄 Ulangi</button>`;document.getElementById('result').style.display='block';document.getElementById('indicator').style.display='none';document.querySelector('.progress-bar').style.display='none';}
function updateProgress(){document.getElementById('progress').style.width=((currentQuestion+1)/quizData.length*100)+'%';}
function renderButtons(){document.getElementById('buttons').innerHTML=!answered?'<button class="clay-btn clay-btn-primary flex-fill justify-content-center" onclick="checkAnswer()">✓ Cek Jawaban</button>':'<button class="clay-btn clay-btn-primary flex-fill justify-content-center" onclick="nextQuestion()">'+(currentQuestion<quizData.length-1?'→ Berikutnya':'🎯 Lihat Hasil')+'</button>';}
fetch('{{ route("kuis.index") }}?tipe=pelatihan').then(r=>r.json()).then(result=>{if(result.success&&result.data.length>0){quizData=result.data;init();}else{document.getElementById('quizContent').innerHTML='<div style="text-align:center;padding:50px;"><span style="font-size:4em">📭</span><h3 style="color:var(--color-clay-text-muted);">Belum ada soal.</h3></div>';}});
</script>
