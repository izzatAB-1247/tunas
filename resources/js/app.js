// 3D Card Tilt Interaction
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.tilt-card').forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            const rotateX = ((y - centerY) / centerY) * -10;
            const rotateY = ((x - centerX) / centerX) * 10;
            card.style.transform = `perspective(800px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.02, 1.02, 1.02)`;
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'perspective(800px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1)';
        });
    });

    // Sidebar active state sync with bottom nav
    const currentPath = window.location.pathname;
    const pageParam = new URLSearchParams(window.location.search).get('page') || 'beranda';

    document.querySelectorAll('.bnav-item').forEach(item => {
        const page = item.dataset.page;
        if (page === pageParam) item.classList.add('active');
    });

    // Close sidebar on nav click (mobile)
    document.querySelectorAll('.clay-sidebar .menu-item').forEach(item => {
        item.addEventListener('click', () => {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            if (sidebar && window.innerWidth <= 768) {
                sidebar.classList.remove('open');
                if (overlay) overlay.classList.remove('show');
            }
        });
    });
});
