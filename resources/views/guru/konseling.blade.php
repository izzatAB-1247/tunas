@php
    $pageTitle = 'Grup Konseling';
@endphp

{{-- List View --}}
<div id="konseling-list-view">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-headline-md text-primary">Grup Konseling</h2>
        <button class="clay-button bg-primary text-white px-6 py-3 rounded-2xl flex items-center gap-2" data-bs-toggle="modal" data-bs-target="#modalTambahKonseling">
            <span class="material-symbols-outlined">add</span>
            <span class="font-label-md">Buat Grup</span>
        </button>
    </div>

    <div id="konseling-list" class="flex flex-col gap-4">
        {{-- diisi JavaScript --}}
    </div>
</div>

{{-- Detail View --}}
<div id="konseling-detail-view" class="hidden">
    <button onclick="backToList()" class="clay-button px-4 py-2 rounded-xl text-sm bg-surface flex items-center gap-2 mb-4">
        <span class="material-symbols-outlined text-sm">arrow_back</span>
        <span>Kembali</span>
    </button>

    <div id="detail-header" class="clay-card p-6 mb-4"></div>

    {{-- Tab Navigation --}}
    <div class="flex gap-2 mb-4 overflow-x-auto">
        <button class="tab-btn clay-button px-4 py-2 rounded-xl text-sm bg-primary text-white" data-tab="anggota" onclick="switchTab('anggota')">Anggota</button>
        <button class="tab-btn clay-button px-4 py-2 rounded-xl text-sm bg-surface" data-tab="sesi" onclick="switchTab('sesi')">Sesi</button>
        <button class="tab-btn clay-button px-4 py-2 rounded-xl text-sm bg-surface" data-tab="presensi" onclick="switchTab('presensi')">Presensi</button>
        <button class="tab-btn clay-button px-4 py-2 rounded-xl text-sm bg-surface" data-tab="laporan" onclick="switchTab('laporan')">Laporan</button>
        <button class="tab-btn clay-button px-4 py-2 rounded-xl text-sm bg-surface" data-tab="diskusi" onclick="switchTab('diskusi')">Diskusi</button>
    </div>

    <div id="tab-content">
        <div id="tab-anggota" class="tab-pane"></div>
        <div id="tab-sesi" class="tab-pane hidden"></div>
        <div id="tab-presensi" class="tab-pane hidden"></div>
        <div id="tab-laporan" class="tab-pane hidden"></div>
        <div id="tab-diskusi" class="tab-pane hidden">
            <h4 class="font-headline-md text-primary mb-3">Diskusi</h4>
            <div id="message-list" class="flex flex-col gap-3 mb-4 max-h-96 overflow-y-auto">
                <p class="font-body-md text-on-surface-variant clay-card p-4 text-center">Memuat pesan...</p>
            </div>
            <form id="send-message-form" class="flex gap-2">
                <input type="text" id="msg-input" class="form-control clay-inset rounded-2xl border-0 p-3 w-full bg-white/50" placeholder="Tulis pesan..." required>
                <button type="submit" class="clay-button bg-primary text-white px-4 py-2 rounded-2xl">
                    <span class="material-symbols-outlined">send</span>
                </button>
            </form>
        </div>
    </div>
</div>

{{-- Modal Tambah/Edit Grup --}}
<div class="modal fade" id="modalTambahKonseling" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 2rem; background: #FAF5EF;">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title text-headline-md text-primary" id="modalKonselingTitle">Buat Grup Konseling</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formKonseling" class="flex flex-col gap-4">
                    <input type="hidden" id="edit_id">

                    <div>
                        <label class="font-label-md text-on-surface-variant mb-1 block">Nama Grup</label>
                        <input type="text" id="nama" class="form-control clay-inset rounded-2xl border-0 p-4 w-full bg-white/50" required>
                    </div>

                    <div>
                        <label class="font-label-md text-on-surface-variant mb-1 block">Deskripsi</label>
                        <textarea id="deskripsi" class="form-control clay-inset rounded-2xl border-0 p-4 w-full bg-white/50" rows="3"></textarea>
                    </div>

                    <div>
                        <label class="font-label-md text-on-surface-variant mb-1 block">Kuota Peserta</label>
                        <input type="number" id="kuota" class="form-control clay-inset rounded-2xl border-0 p-4 w-full bg-white/50" value="10" min="1" max="100" required>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="font-label-md text-on-surface-variant mb-1 block">Hari</label>
                            <select id="hari" class="form-control clay-inset rounded-2xl border-0 p-4 w-full bg-white/50">
                                <option value="">Pilih Hari</option>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                            </select>
                        </div>
                        <div>
                            <label class="font-label-md text-on-surface-variant mb-1 block">Status</label>
                            <select id="status" class="form-control clay-inset rounded-2xl border-0 p-4 w-full bg-white/50">
                                <option value="aktif">Aktif</option>
                                <option value="selesai">Selesai</option>
                                <option value="dibatalkan">Dibatalkan</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="font-label-md text-on-surface-variant mb-1 block">Waktu Mulai</label>
                            <input type="time" id="waktu_mulai" class="form-control clay-inset rounded-2xl border-0 p-4 w-full bg-white/50">
                        </div>
                        <div>
                            <label class="font-label-md text-on-surface-variant mb-1 block">Waktu Selesai</label>
                            <input type="time" id="waktu_selesai" class="form-control clay-inset rounded-2xl border-0 p-4 w-full bg-white/50">
                        </div>
                    </div>

                    <div id="konselingError" class="text-error font-label-md hidden"></div>

                    <button type="submit" class="clay-button bg-primary text-white w-full py-4 rounded-2xl font-label-md mt-2">
                        Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal Tambah Sesi --}}
<div class="modal fade" id="modalTambahSesi" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 2rem; background: #FAF5EF;">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title text-headline-md text-primary">Buat Sesi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formSesi" class="flex flex-col gap-4">
                    <div>
                        <label class="font-label-md text-on-surface-variant mb-1 block">Judul</label>
                        <input type="text" id="sesi_judul" class="form-control clay-inset rounded-2xl border-0 p-4 w-full bg-white/50" required>
                    </div>
                    <div>
                        <label class="font-label-md text-on-surface-variant mb-1 block">Deskripsi</label>
                        <textarea id="sesi_deskripsi" class="form-control clay-inset rounded-2xl border-0 p-4 w-full bg-white/50" rows="2"></textarea>
                    </div>
                    <div>
                        <label class="font-label-md text-on-surface-variant mb-1 block">Tanggal</label>
                        <input type="date" id="sesi_tanggal" class="form-control clay-inset rounded-2xl border-0 p-4 w-full bg-white/50" required>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="font-label-md text-on-surface-variant mb-1 block">Mulai</label>
                            <input type="time" id="sesi_mulai" class="form-control clay-inset rounded-2xl border-0 p-4 w-full bg-white/50">
                        </div>
                        <div>
                            <label class="font-label-md text-on-surface-variant mb-1 block">Selesai</label>
                            <input type="time" id="sesi_selesai" class="form-control clay-inset rounded-2xl border-0 p-4 w-full bg-white/50">
                        </div>
                    </div>
                    <div>
                        <label class="font-label-md text-on-surface-variant mb-1 block">Tempat</label>
                        <input type="text" id="sesi_tempat" class="form-control clay-inset rounded-2xl border-0 p-4 w-full bg-white/50">
                    </div>
                    <button type="submit" class="clay-button bg-primary text-white w-full py-4 rounded-2xl font-label-md mt-2">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
let currentGroupId = null;
let currentGroup = null;

const params = new URLSearchParams(window.location.search);
const groupId = params.get('group_id');

if (groupId) {
    currentGroupId = parseInt(groupId);
}

async function loadKonseling() {
    try {
        const res = await fetch('{{ route("guru.konseling.index") }}', {
            headers: { 'Accept': 'application/json' }
        });
        const data = await res.json();
        const list = document.getElementById('konseling-list');

        if (!data.success || data.groups.length === 0) {
            list.innerHTML = `
                <div class="clay-card p-8 text-center">
                    <span class="material-symbols-outlined text-6xl text-outline mb-4" style="font-size: 64px;">group</span>
                    <p class="font-body-md text-on-surface-variant">Belum ada grup konseling.</p>
                    <p class="font-label-md text-on-surface-variant mt-2">Klik "Buat Grup" untuk memulai.</p>
                </div>
            `;
            return;
        }

        list.innerHTML = data.groups.map(g => `
            <div class="clay-card p-6">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h3 class="font-headline-md text-primary">${g.nama}</h3>
                        <p class="font-body-md text-on-surface-variant mt-1">${g.deskripsi || 'Tidak ada deskripsi'}</p>
                        <div class="flex items-center gap-4 mt-3 text-sm text-on-surface-variant">
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-base">group</span>
                                ${g.approved_members_count}/${g.kuota}
                            </span>
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-base">pending_actions</span>
                                ${g.pending_members_count} pending
                            </span>
                            ${g.hari ? `<span class="flex items-center gap-1"><span class="material-symbols-outlined text-base">calendar_today</span>${g.hari}</span>` : ''}
                        </div>
                    </div>
                    <span class="px-3 py-1 rounded-xl text-xs font-bold ${g.status === 'aktif' ? 'bg-green-100 text-green-700' : g.status === 'selesai' ? 'bg-blue-100 text-blue-700' : 'bg-red-100 text-red-700'}">${g.status}</span>
                </div>
                <div class="flex gap-2 mt-4">
                    <button class="clay-button px-4 py-2 rounded-xl text-sm bg-surface" onclick="detailGroup(${g.id})">
                        <span class="material-symbols-outlined text-sm">visibility</span> Detail
                    </button>
                    <button class="clay-button px-4 py-2 rounded-xl text-sm bg-surface" onclick="editGroup(${JSON.stringify(g).replace(/"/g, '&quot;')})">
                        <span class="material-symbols-outlined text-sm">edit</span> Edit
                    </button>
                    <button class="clay-button px-4 py-2 rounded-xl text-sm bg-surface text-error" onclick="deleteGroup(${g.id})">
                        <span class="material-symbols-outlined text-sm">delete</span> Hapus
                    </button>
                </div>
            </div>
        `).join('');
    } catch (e) {
        console.error('Gagal memuat grup konseling:', e);
    }
}

function detailGroup(id) {
    currentGroupId = id;
    document.getElementById('konseling-list-view').classList.add('hidden');
    document.getElementById('konseling-detail-view').classList.remove('hidden');
    loadGroupDetail(id);
    switchTab('anggota');
}

function backToList() {
    currentGroupId = null;
    currentGroup = null;
    document.getElementById('konseling-list-view').classList.remove('hidden');
    document.getElementById('konseling-detail-view').classList.add('hidden');
    window.history.replaceState({}, '', '{{ route("guru.dashboard", ["page" => "konseling"]) }}');
}

async function loadGroupDetail(id) {
    try {
        const res = await fetch(`/guru/konseling/${id}`, {
            headers: { 'Accept': 'application/json' }
        });
        const data = await res.json();

        if (!data.success) {
            alert(data.message || 'Gagal memuat detail grup.');
            backToList();
            return;
        }

        currentGroup = data.group;
        renderDetailHeader(data.group);
        renderAnggotaTab(data.group);
        loadSesiTab(data.group.id);
        loadDiskusiTab(data.group.id);
    } catch (e) {
        console.error('Gagal memuat detail grup:', e);
    }
}

function renderDetailHeader(g) {
    document.getElementById('detail-header').innerHTML = `
        <div class="flex items-start justify-between">
            <div>
                <h3 class="text-headline-md text-primary">${g.nama}</h3>
                <p class="font-body-md text-on-surface-variant mt-1">${g.deskripsi || 'Tidak ada deskripsi'}</p>
                <div class="flex items-center gap-4 mt-2 text-sm text-on-surface-variant">
                    <span>👤 Kuota: ${g.members?.length || 0}/${g.kuota}</span>
                    ${g.hari ? `<span>📅 ${g.hari}</span>` : ''}
                    ${g.waktu_mulai ? `<span>⏰ ${g.waktu_mulai} - ${g.waktu_selesai || '?'}</span>` : ''}
                </div>
            </div>
            <span class="px-3 py-1 rounded-xl text-xs font-bold ${g.status === 'aktif' ? 'bg-green-100 text-green-700' : g.status === 'selesai' ? 'bg-blue-100 text-blue-700' : 'bg-red-100 text-red-700'}">${g.status}</span>
        </div>
    `;
}

function renderAnggotaTab(g) {
    const members = g.members || [];
    const pending = members.filter(m => m.status === 'pending');
    const approved = members.filter(m => m.status === 'approved');
    const rejected = members.filter(m => m.status === 'rejected');

    let html = '';

    html += `<h4 class="font-headline-md text-primary mb-3">Pending (${pending.length})</h4>`;
    if (pending.length === 0) {
        html += `<p class="font-body-md text-on-surface-variant mb-4 clay-card p-4">Tidak ada permintaan pending.</p>`;
    } else {
        html += `<div class="flex flex-col gap-3 mb-6">`;
        pending.forEach(m => {
            const nama = m.siswa?.nama_lengkap || 'Siswa';
            html += `
                <div class="clay-card p-4 flex items-center justify-between">
                    <div>
                        <p class="font-label-md">${nama}</p>
                        <p class="text-xs text-on-surface-variant">Menunggu persetujuan</p>
                    </div>
                    <div class="flex gap-2">
                        <button class="clay-button px-4 py-2 rounded-xl text-xs bg-green-100 text-green-700" onclick="approveMember(${g.id}, ${m.id})">Setujui</button>
                        <button class="clay-button px-4 py-2 rounded-xl text-xs bg-red-100 text-red-700" onclick="rejectMember(${g.id}, ${m.id})">Tolak</button>
                    </div>
                </div>
            `;
        });
        html += `</div>`;
    }

    html += `<h4 class="font-headline-md text-primary mb-3">Anggota (${approved.length})</h4>`;
    if (approved.length === 0) {
        html += `<p class="font-body-md text-on-surface-variant mb-4 clay-card p-4">Belum ada anggota disetujui.</p>`;
    } else {
        html += `<div class="flex flex-col gap-3 mb-4">`;
        approved.forEach(m => {
            const nama = m.siswa?.nama_lengkap || 'Siswa';
            html += `
                <div class="clay-card p-4 flex items-center justify-between">
                    <div>
                        <p class="font-label-md">${nama}</p>
                        <p class="text-xs text-on-surface-variant">Disetujui ${m.approved_at ? new Date(m.approved_at).toLocaleDateString('id') : ''}</p>
                    </div>
                </div>
            `;
        });
        html += `</div>`;
    }

    if (rejected.length > 0) {
        html += `<h4 class="font-headline-md text-on-surface-variant mb-3">Ditolak (${rejected.length})</h4>`;
        html += `<div class="flex flex-col gap-3 mb-4">`;
        rejected.forEach(m => {
            const nama = m.siswa?.nama_lengkap || 'Siswa';
            html += `
                <div class="clay-card p-4 flex items-center justify-between opacity-60">
                    <div>
                        <p class="font-label-md">${nama}</p>
                        <p class="text-xs text-red-600">Ditolak</p>
                    </div>
                </div>
            `;
        });
        html += `</div>`;
    }

    document.getElementById('tab-anggota').innerHTML = html;
}

async function approveMember(groupId, memberId) {
    try {
        const res = await fetch(`/guru/konseling/${groupId}/members/${memberId}/approve`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
        });
        const data = await res.json();
        if (data.success) {
            loadGroupDetail(groupId);
        } else {
            alert(data.message);
        }
    } catch (e) {
        alert('Gagal menyetujui anggota.');
    }
}

async function rejectMember(groupId, memberId) {
    try {
        const res = await fetch(`/guru/konseling/${groupId}/members/${memberId}/reject`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
        });
        const data = await res.json();
        if (data.success) {
            loadGroupDetail(groupId);
        } else {
            alert(data.message);
        }
    } catch (e) {
        alert('Gagal menolak anggota.');
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

    if (tab === 'sesi' && currentGroupId) loadSesiTab(currentGroupId);
    if (tab === 'diskusi' && currentGroupId) loadDiskusiTab(currentGroupId);
}

// === SESI TAB ===
async function loadSesiTab(groupId) {
    try {
        const res = await fetch(`/guru/konseling/${groupId}/sessions`, {
            headers: { 'Accept': 'application/json' }
        });
        const data = await res.json();
        const container = document.getElementById('tab-sesi');
        let html = `
            <div class="flex items-center justify-between mb-3">
                <h4 class="font-headline-md text-primary">Sesi Pertemuan</h4>
                <button class="clay-button px-4 py-2 rounded-xl text-sm bg-primary text-white" data-bs-toggle="modal" data-bs-target="#modalTambahSesi">
                    <span class="material-symbols-outlined text-sm">add</span> Tambah
                </button>
            </div>
        `;

        if (!data.success || data.sessions.length === 0) {
            html += `<p class="font-body-md text-on-surface-variant clay-card p-4">Belum ada sesi pertemuan.</p>`;
        } else {
            html += `<div class="flex flex-col gap-3">`;
            data.sessions.forEach(s => {
                html += `
                    <div class="clay-card p-4">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="font-label-md">${s.judul}</p>
                                <p class="text-xs text-on-surface-variant mt-1">📅 ${s.tanggal} ${s.waktu_mulai ? `⏰ ${s.waktu_mulai} - ${s.waktu_selesai || ''}` : ''} ${s.tempat ? `📍 ${s.tempat}` : ''}</p>
                                ${s.deskripsi ? `<p class="text-xs text-on-surface-variant mt-1">${s.deskripsi}</p>` : ''}
                            </div>
                            <span class="px-2 py-0.5 rounded-lg text-xs font-bold ${s.status === 'terjadwal' ? 'bg-blue-100 text-blue-700' : s.status === 'selesai' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'}">${s.status}</span>
                        </div>
                        <div class="flex gap-2 mt-2">
                            <button class="clay-button px-3 py-1 rounded-xl text-xs bg-surface" onclick="editSession(${s.id})">Edit</button>
                            <button class="clay-button px-3 py-1 rounded-xl text-xs bg-surface text-error" onclick="deleteSession(${s.id})">Hapus</button>
                        </div>
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

// === DISKUSI TAB ===
async function loadDiskusiTab(groupId, silent = false) {
    try {
        const res = await fetch(`/guru/konseling/${groupId}/messages`, {
            headers: { 'Accept': 'application/json' }
        });
        const data = await res.json();
        const msgList = document.getElementById('message-list');

        if (!data.success || data.messages.length === 0) {
            msgList.innerHTML = `<p class="font-body-md text-on-surface-variant clay-card p-4 text-center">Belum ada pesan.</p>`;
        } else {
            msgList.innerHTML = data.messages.map(m => {
                const isMe = m.user_id === {{ auth()->id() }};
                return `
                    <div class="clay-card p-3 ${isMe ? 'ml-8 bg-primary-container/20' : 'mr-8 bg-white'}">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-xs font-bold text-primary">${m.user?.nama_lengkap || 'User'}</span>
                            <span class="text-xs text-on-surface-variant">${new Date(m.created_at).toLocaleString('id')}</span>
                        </div>
                        <p class="font-body-md text-sm">${m.pesan}</p>
                    </div>
                `;
            }).join('');
        }

        msgList.scrollTop = msgList.scrollHeight;
    } catch (e) {
        console.error(e);
    }
}

async function sendMessage(e) {
    e.preventDefault();
    if (!currentGroupId) return;

    const input = document.getElementById('msg-input');
    const pesan = input.value.trim();
    if (!pesan) return;

    try {
        const res = await fetch(`/guru/konseling/${currentGroupId}/messages`, {
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
            loadDiskusiTab(currentGroupId);
        }
    } catch (e) {
        console.error(e);
    }
}

document.getElementById('send-message-form')?.addEventListener('submit', sendMessage);

// === FORM GROUP ===
function editGroup(group) {
    document.getElementById('modalKonselingTitle').textContent = 'Edit Grup Konseling';
    document.getElementById('edit_id').value = group.id;
    document.getElementById('nama').value = group.nama;
    document.getElementById('deskripsi').value = group.deskripsi || '';
    document.getElementById('kuota').value = group.kuota;
    document.getElementById('hari').value = group.hari || '';
    document.getElementById('status').value = group.status;
    document.getElementById('waktu_mulai').value = group.waktu_mulai || '';
    document.getElementById('waktu_selesai').value = group.waktu_selesai || '';

    new bootstrap.Modal(document.getElementById('modalTambahKonseling')).show();
}

function deleteGroup(id) {
    if (!confirm('Hapus grup konseling ini?')) return;

    fetch(`/guru/konseling/${id}`, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
    })
    .then(r => r.json())
    .then(d => {
        if (d.success) { loadKonseling(); }
        else { alert(d.message); }
    });
}

document.getElementById('formKonseling').addEventListener('submit', async function(e) {
    e.preventDefault();

    const id = document.getElementById('edit_id').value;
    const method = id ? 'PUT' : 'POST';
    const url = id ? `/guru/konseling/${id}` : '{{ route("guru.konseling.store") }}';

    const payload = {
        nama: document.getElementById('nama').value,
        deskripsi: document.getElementById('deskripsi').value,
        kuota: document.getElementById('kuota').value,
        hari: document.getElementById('hari').value,
        waktu_mulai: document.getElementById('waktu_mulai').value,
        waktu_selesai: document.getElementById('waktu_selesai').value,
    };

    if (id) payload.status = document.getElementById('status').value;

    try {
        const res = await fetch(url, {
            method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: JSON.stringify(payload),
        });

        const data = await res.json();

        if (data.success) {
            bootstrap.Modal.getInstance(document.getElementById('modalTambahKonseling')).hide();
            document.getElementById('formKonseling').reset();
            document.getElementById('edit_id').value = '';
            document.getElementById('modalKonselingTitle').textContent = 'Buat Grup Konseling';
            loadKonseling();
        } else {
            alert(data.message || 'Gagal menyimpan.');
        }
    } catch (e) {
        alert('Terjadi kesalahan.');
    }
});

// === FORM SESI ===
document.getElementById('formSesi').addEventListener('submit', async function(e) {
    e.preventDefault();
    if (!currentGroupId) return;

    const payload = {
        judul: document.getElementById('sesi_judul').value,
        deskripsi: document.getElementById('sesi_deskripsi').value,
        tanggal: document.getElementById('sesi_tanggal').value,
        waktu_mulai: document.getElementById('sesi_mulai').value,
        waktu_selesai: document.getElementById('sesi_selesai').value,
        tempat: document.getElementById('sesi_tempat').value,
    };

    try {
        const res = await fetch(`/guru/konseling/${currentGroupId}/sessions`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify(payload),
        });
        const data = await res.json();
        if (data.success) {
            bootstrap.Modal.getInstance(document.getElementById('modalTambahSesi')).hide();
            document.getElementById('formSesi').reset();
            loadSesiTab(currentGroupId);
        } else {
            alert(data.message || 'Gagal menyimpan sesi.');
        }
    } catch (e) {
        alert('Terjadi kesalahan.');
    }
});

// Auto-load detail if group_id in URL
if (currentGroupId) {
    detailGroup(currentGroupId);
} else {
    loadKonseling();
}
</script>
@endpush
