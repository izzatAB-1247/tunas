<div class="modal fade clay-modal" id="addVideoModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="modalAddTitle">Tambah Materi YouTube</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addVideoForm">
                    <div class="mb-3">
                        <label class="fw-semibold" style="font-size:13px;">URL YouTube</label>
                        <input type="text" class="clay-input" id="youtubeURL" placeholder="https://www.youtube.com/watch?v=..." required>
                    </div>
                    <div class="mb-3">
                        <label class="fw-semibold" style="font-size:13px;">Judul</label>
                        <input type="text" class="clay-input" id="videoTitle" required>
                    </div>
                    <div class="mb-3">
                        <label class="fw-semibold" style="font-size:13px;">Kategori</label>
                        <select class="clay-select" id="videoCategory" required>
                            <option value="">Pilih Kategori</option>
                            <option value="Curriculum Vitae">CV & Resume</option>
                            <option value="Interview">Teknik Wawancara</option>
                            <option value="Portofolio">Portofolio</option>
                            <option value="Soft Skills">Soft Skills</option>
                            <option value="Etika Kerja">Etika & Budaya Kerja</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="fw-semibold" style="font-size:13px;">Deskripsi</label>
                        <textarea class="clay-input" id="videoDescription" rows="3"></textarea>
                    </div>
                    <button type="submit" class="clay-btn clay-btn-primary w-100 justify-content-center">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade clay-modal" id="videoModal" tabindex="-1">
    <div class="modal-dialog modal-fullscreen-md-down modal-xl modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0 bg-dark text-white">
                <h5 class="modal-title" id="videoModalTitle"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0 bg-dark">
                <div class="ratio ratio-16x9">
                    <iframe id="videoFrame" src="" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
            </div>
            <div class="modal-footer border-0">
                <div id="videoDesc" class="w-100"></div>
            </div>
        </div>
    </div>
</div>
