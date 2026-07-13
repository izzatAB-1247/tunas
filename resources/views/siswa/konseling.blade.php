@php
    $pageTitle = 'Grup Konseling';
@endphp

{{-- List View --}}
<div id="konseling-list-view">
    <h2 class="text-headline-md text-primary mb-6">Grup Konseling</h2>

    <div id="my-groups-section" class="mb-8">
        <h3 class="font-headline-md text-primary mb-4">Grup Saya</h3>
        <div id="my-groups" class="flex flex-col gap-4"></div>
    </div>

    <div id="available-groups-section">
        <h3 class="font-headline-md text-primary mb-4">Grup Tersedia</h3>
        <div id="available-groups" class="flex flex-col gap-4"></div>
    </div>
</div>

{{-- Detail View (Diskusi & Sesi) --}}
<div id="konseling-detail-view" class="hidden">
    <button onclick="backToList()" class="clay-button px-4 py-2 rounded-xl text-sm bg-surface flex items-center gap-2 mb-4">
        <span class="material-symbols-outlined text-sm">arrow_back</span>
        <span>Kembali</span>
    </button>

    <div id="detail-header" class="clay-card p-6 mb-4"></div>

    <div class="flex gap-2 mb-4">
        <button class="tab-btn clay-button px-4 py-2 rounded-xl text-sm bg-primary text-white" data-tab="diskusi" onclick="switchTab('diskusi')">Diskusi</button>
        <button class="tab-btn clay-button px-4 py-2 rounded-xl text-sm bg-surface" data-tab="sesi" onclick="switchTab('sesi')">Sesi</button>
    </div>

    <div id="tab-content">
        <div id="tab-diskusi" class="tab-pane">
            <h4 class="font-headline-md text-primary mb-3">Diskusi</h4>
            <div id="message-list" class="flex flex-col gap-3 mb-4 max-h-96 overflow-y-auto px-1">
                <p class="font-body-md text-on-surface-variant clay-card p-4 text-center">Memuat pesan...</p>
            </div>
            <form id="send-message-form" class="flex gap-2">
                <input type="text" id="msg-input" class="form-control clay-inset rounded-2xl border-0 p-3 w-full bg-white/50" placeholder="Tulis pesan..." required>
                <button type="submit" class="clay-button bg-primary text-white px-4 py-2 rounded-2xl">
                    <span class="material-symbols-outlined">send</span>
                </button>
            </form>
        </div>
        <div id="tab-sesi" class="tab-pane hidden"></div>
    </div>
</div>

@push('scripts')
<script>
let currentGroupId = null;
let msgInterval = null;

const params = new URLSearchParams(window.location.search);
const groupId = params.get('group_id');

function detailGroup(id) {
    currentGroupId = id;
    document.getElementById('konseling-list-view').classList.add('hidden');
    document.getElementById('konseling-detail-view').classList.remove('hidden');
    loadGroupDetail(id);
    switchTab('diskusi');
}

function backToList() {
    if (msgInterval) clearInterval(msgInterval);
    currentGroupId = null;
    document.getElementById('konseling-list-view').classList.remove('hidden');
    document.getElementById('konseling-detail-view').classList.add('hidden');
    window.history.replaceState({}, '', '{{ route("siswa.dashboard", ["page" => "konseling"]) }}');
}

async function loadGroupDetail(id) {
    try {
        const res = await fetch(`/siswa/konseling/${id}`, {
            headers: { 'Accept': 'application/json' }
        });
        const data = await res.json();

        if (!data.success) {
            alert(data.message || 'Gagal memuat detail grup.');
            backToList();
            return;
        }

        const g = data.group;
        document.getElementById('detail-header').innerHTML = `
            <div>
                <h3 class="text-headline-md text-primary">${g.nama}</h3>
                <p class="font-body-md text-on-surface-variant mt-1">${g.deskripsi || 'Tidak ada deskripsi'}</p>
                <p class="font-label-md text-on-surface-variant mt-2">Oleh: ${g.guru?.nama_lengkap || 'Guru'}</p>
                <div class="flex items-center gap-4 mt-2 text-sm text-on-surface-variant">
                    <span>👤 ${g.approved_members_count} anggota</span>
                    ${g.hari ? `<span>📅 ${g.hari}</span>` : ''}
                </div>
            </div>
        `;

        loadMessages(id);
        loadSessions(id);
    } catch (e) {
        console.error('Gagal memuat detail grup:', e);
    }
}

function switchTab(tab) {
    document.querySelectorAll('.tab-pane').forEach(el => el.classList.add('hidden'));
    document.getElementById(`tab-${tab}`).classList.remove('hidden');

    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('bg-primary', 'text-white');
        btn.classList.add('bg-surface');
    });
    const activeBtn = document.querySelector(`.tab-btn[data-tab="${tab}"]`);
    if (activeBtn) {
        activeBtn.classList.remove('bg-surface');
        activeBtn.classList.add('bg-primary', 'text-white');
    }

    if (tab === 'diskusi' && currentGroupId) {
        loadMessages(currentGroupId);
        if (msgInterval) clearInterval(msgInterval);
        msgInterval = setInterval(() => loadMessages(currentGroupId, true), 5000);
    } else {
        if (msgInterval) clearInterval(msgInterval);
    }
}

// === DISKUSI TAB ===
async function loadMessages(groupId, silent = false) {
    try {
        const res = await fetch(`/siswa/konseling/${groupId}/messages`, {
            headers: { 'Accept': 'application/json' }
        });
        const data = await res.json();

        const msgList = document.getElementById('message-list');

        if (!data.success) {
            if (!silent && msgList) {
                msgList.innerHTML = `<p class="font-body-md text-on-surface-variant clay-card p-4 text-center">Gagal memuat pesan.</p>`;
            }
            return;
        }

        if (data.messages.length === 0) {
            msgList.innerHTML = `<p class="font-body-md text-on-surface-variant clay-card p-4 text-center">Belum ada pesan. Mulai diskusi!</p>`;
        } else {
            msgList.innerHTML = data.messages.map(m => {
                const isMe = m.user_id === {{ auth()->id() }};
                return `
                    <div class="clay-card p-3 ${isMe ? 'ml-8 bg-primary-container/20' : 'mr-8 bg-white'}">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-xs font-bold text-primary">${isMe ? 'Saya' : (m.user?.nama_lengkap || 'Guru')}</span>
                            <span class="text-xs text-on-surface-variant">${new Date(m.created_at).toLocaleString('id')}</span>
                        </div>
                        <p class="font-body-md text-sm">${m.pesan}</p>
                    </div>
                `;
            }).join('');
        }

        msgList.scrollTop = msgList.scrollHeight;
    } catch (e) {
        if (!silent) {
            const msgList = document.getElementById('message-list');
            if (msgList) msgList.innerHTML = `<p class="font-body-md text-on-surface-variant clay-card p-4 text-center">Gagal memuat pesan.</p>`;
        }
    }
}

async function sendMessage(e) {
    e.preventDefault();
    if (!currentGroupId) return;

    const input = document.getElementById('msg-input');
    const pesan = input.value.trim();
    if (!pesan) return;

    try {
        const res = await fetch(`/siswa/konseling/${currentGroupId}/messages`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ pesan })
        });
        const data = await res.json();
        if (data.success) {
            input.value = '';
            loadMessages(currentGroupId);
        } else {
            alert(data.message || 'Gagal mengirim pesan.');
        }
    } catch (e) {
        alert('Gagal mengirim pesan.');
    }
}

document.getElementById('send-message-form')?.addEventListener('submit', sendMessage);

// === SESI TAB ===
async function loadSessions(groupId) {
    try {
        const res = await fetch(`/siswa/konseling/${groupId}/sessions`, {
            headers: { 'Accept': 'application/json' }
        });
        const data = await res.json();
        const container = document.getElementById('tab-sesi');
        let html = `
            <h4 class="font-headline-md text-primary mb-3">Sesi Pertemuan</h4>
        `;

        if (!data.success || data.sessions.length === 0) {
            html += `<p class="font-body-md text-on-surface-variant clay-card p-4 text-center">Belum ada sesi pertemuan.</p>`;
        } else {
            html += `<div class="flex flex-col gap-3">`;
            data.sessions.forEach(s => {
                html += `
                    <div class="clay-card p-4">
                        <p class="font-label-md">${s.judul}</p>
                        <p class="text-xs text-on-surface-variant mt-1">📅 ${s.tanggal} ${s.waktu_mulai ? `⏰ ${s.waktu_mulai} - ${s.waktu_selesai || ''}` : ''}</p>
                        ${s.tempat ? `<p class="text-xs text-on-surface-variant">📍 ${s.tempat}</p>` : ''}
                        ${s.deskripsi ? `<p class="text-xs text-on-surface-variant mt-1">${s.deskripsi}</p>` : ''}
                        <span class="inline-block mt-2 px-2 py-0.5 rounded-lg text-xs font-bold ${s.status === 'terjadwal' ? 'bg-blue-100 text-blue-700' : s.status === 'selesai' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'}">${s.status}</span>
                    </div>
                `;
            });
            html += `</div>`;
        }
        container.innerHTML = html;
    } catch (e) {
        console.error(e);
    }
}

// === FUNGSI EXISTING ===
function viewMessages(id) {
    detailGroup(id);
}

async function loadSiswaKonseling() {
    try {
        const res = await fetch('{{ route("siswa.konseling.index") }}', {
            headers: { 'Accept': 'application/json' }
        });
        const data = await res.json();

        renderMyGroups(data.my_groups);
        renderAvailableGroups(data.available_groups);
    } catch (e) {
        console.error('Gagal memuat konseling:', e);
    }
}

function renderMyGroups(groups) {
    const container = document.getElementById('my-groups');

    if (groups.length === 0) {
        container.innerHTML = `
            <div class="clay-card p-6 text-center">
                <span class="material-symbols-outlined text-6xl text-outline mb-4" style="font-size: 48px;">group_off</span>
                <p class="font-body-md text-on-surface-variant">Belum bergabung grup manapun.</p>
            </div>
        `;
        return;
    }

    container.innerHTML = groups.map(g => {
        const membership = g.members?.[0];
        const statusBadge = membership?.status === 'approved' ? 'bg-green-100 text-green-700' :
                           membership?.status === 'pending' ? 'bg-yellow-100 text-yellow-700' :
                           'bg-red-100 text-red-700';

        return `
            <div class="clay-card p-6">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h4 class="font-headline-md text-primary">${g.nama}</h4>
                        <p class="font-body-md text-on-surface-variant mt-1">${g.deskripsi || 'Tidak ada deskripsi'}</p>
                        <p class="font-label-md text-on-surface-variant mt-2">Oleh: ${g.guru?.nama_lengkap || 'Guru'}</p>
                        <div class="flex items-center gap-4 mt-2 text-sm text-on-surface-variant">
                            <span class="flex items-center gap-1"><span class="material-symbols-outlined text-base">group</span>${g.approved_members_count} anggota</span>
                            ${g.hari ? `<span class="flex items-center gap-1"><span class="material-symbols-outlined text-base">calendar_today</span>${g.hari}</span>` : ''}
                        </div>
                    </div>
                    <span class="px-3 py-1 rounded-xl text-xs font-bold ${statusBadge}">${membership?.status || '-'}</span>
                </div>
                ${membership?.status === 'approved' ? `
                <div class="flex gap-2 mt-4">
                    <button class="clay-button px-4 py-2 rounded-xl text-sm bg-surface" onclick="viewMessages(${g.id})">
                        <span class="material-symbols-outlined text-sm">chat</span> Diskusi
                    </button>
                    <button class="clay-button px-4 py-2 rounded-xl text-sm bg-surface" onclick="leaveGroup(${g.id})">
                        <span class="material-symbols-outlined text-sm">exit_to_app</span> Keluar
                    </button>
                </div>` : membership?.status === 'pending' ? `
                <div class="flex gap-2 mt-4">
                    <span class="px-4 py-2 rounded-xl text-sm bg-yellow-50 text-yellow-700">Menunggu persetujuan guru</span>
                </div>` : ''}
            </div>
        `;
    }).join('');
}

function renderAvailableGroups(groups) {
    const container = document.getElementById('available-groups');

    if (groups.length === 0) {
        container.innerHTML = `
            <div class="clay-card p-6 text-center">
                <span class="material-symbols-outlined text-6xl text-outline mb-4" style="font-size: 48px;">group_add</span>
                <p class="font-body-md text-on-surface-variant">Tidak ada grup tersedia saat ini.</p>
            </div>
        `;
        return;
    }

    container.innerHTML = groups.map(g => `
        <div class="clay-card p-6">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <h4 class="font-headline-md text-primary">${g.nama}</h4>
                    <p class="font-body-md text-on-surface-variant mt-1">${g.deskripsi || 'Tidak ada deskripsi'}</p>
                    <p class="font-label-md text-on-surface-variant mt-2">Oleh: ${g.guru?.nama_lengkap || 'Guru'}</p>
                    <div class="flex items-center gap-4 mt-2 text-sm text-on-surface-variant">
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-base">group</span>${g.approved_members_count}/${g.kuota}</span>
                        ${g.hari ? `<span class="flex items-center gap-1"><span class="material-symbols-outlined text-base">calendar_today</span>${g.hari}</span>` : ''}
                    </div>
                </div>
            </div>
            <div class="flex gap-2 mt-4">
                <button class="clay-button px-4 py-2 rounded-xl text-sm bg-primary text-white" onclick="joinGroup(${g.id})">
                    <span class="material-symbols-outlined text-sm">group_add</span> Gabung
                </button>
            </div>
        </div>
    `).join('');
}

async function joinGroup(id) {
    try {
        const res = await fetch(`/siswa/konseling/${id}/join`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
        });
        const data = await res.json();
        alert(data.message);
        if (data.success) loadSiswaKonseling();
    } catch (e) {
        alert('Gagal bergabung.');
    }
}

async function leaveGroup(id) {
    if (!confirm('Keluar dari grup ini?')) return;
    try {
        const res = await fetch(`/siswa/konseling/${id}/leave`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
        });
        const data = await res.json();
        alert(data.message);
        if (data.success) loadSiswaKonseling();
    } catch (e) {
        alert('Gagal keluar.');
    }
}

// Auto-load detail if group_id in URL
if (groupId) {
    detailGroup(parseInt(groupId));
} else {
    loadSiswaKonseling();
}
</script>
@endpush
