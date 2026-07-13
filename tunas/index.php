<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TUNAS - Tunarungu Siap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            overflow-x: hidden;
            background-image: url('images/background.jpg');
            background-repeat: no-repeat;
            background-position: center top;
            background-size: cover;
            background-attachment: fixed;
            position: relative;
        }
        
        /* Overlay untuk membuat teks lebih terbaca */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.55);
            backdrop-filter: blur(2px);
            z-index: 0;
        }
        
        /* Semua konten di atas overlay */
        .content-wrapper {
            position: relative;
            z-index: 1;
        }
        
        /* Navbar */
        .navbar {
            background: rgba(255, 255, 255, 0.9) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }
        
        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.95) !important;
            box-shadow: 0 2px 20px rgba(0,0,0,0.12);
        }
        
        .navbar-brand {
            font-weight: 900;
            font-size: 1.8rem;
            color: #0b2545 !important;
            font-style: italic;
            letter-spacing: -1px;
        }
        
        .navbar-brand i {
            font-size: 1.8rem;
            margin-right: 10px;
        }
        
        .nav-link {
            color: #0b2545 !important;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover {
            color: #6B7FD7 !important;
        }
        
        /* Hero Section */
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 100px 0 80px;
        }
        
        .hero-content {
            text-align: center;
            padding: 40px 20px;
        }
        
        .hero-logo {
            width: 150px;
            height: 150px;
            background: rgba(107, 127, 215, 0.15);
            border: 5px solid rgba(107, 127, 215, 0.3);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
            animation: float 3s ease-in-out infinite;
        }
        
        .hero-logo i {
            font-size: 70px;
            color: #6B7FD7;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .hero-title {
            font-size: 4rem;
            font-weight: 900;
            margin-bottom: 20px;
            color: #0b2545;
            text-shadow: 2px 2px 4px rgba(255,255,255,0.8);
            animation: fadeInUp 0.8s ease-out;
            font-style: italic;
            letter-spacing: -1px;
        }
        
        .hero-subtitle {
            font-size: 1.3rem;
            margin-bottom: 30px;
            font-weight: 700;
            color: #0b2545;
            letter-spacing: 2px;
            animation: fadeInUp 1s ease-out;
            text-transform: uppercase;
        }
        
        .hero-description {
            max-width: 800px;
            margin: 0 auto 40px;
            font-size: 1.1rem;
            line-height: 1.8;
            background: rgba(255, 255, 255, 0.6);
            padding: 30px;
            border-radius: 15px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(107, 127, 215, 0.2);
            animation: fadeInUp 1.2s ease-out;
            color: #333;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .login-btn {
            background: linear-gradient(135deg, #ff8f2f, #ff6a00);
            color: white;
            border: none;
            padding: 18px 60px;
            font-size: 1.3rem;
            font-weight: 700;
            border-radius: 50px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(255, 106, 0, 0.3);
            animation: fadeInUp 1.4s ease-out;
            display: inline-block;
        }
        
        .login-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(255, 106, 0, 0.4);
            background: linear-gradient(135deg, #ff9e3f, #ff7a1a);
        }
        
        /* Stats Section */
        .stats-section {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            padding: 80px 0;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 60px;
        }
        
        .section-title h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #0b2545;
            margin-bottom: 15px;
        }
        
        .section-title p {
            font-size: 1.1rem;
            color: #666;
        }
        
        .stat-card {
            background: linear-gradient(135deg, rgba(139,127,215,0.95) 0%, rgba(107,127,215,0.95) 100%);
            padding: 40px 30px;
            border-radius: 20px;
            text-align: center;
            color: white;
            box-shadow: 0 10px 30px rgba(107, 127, 215, 0.3);
            transition: all 0.3s ease;
            margin-bottom: 30px;
            height: 100%;
            border: 2px solid rgba(167,139,250,0.18);
        }
        
        .stat-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(107, 127, 215, 0.4);
        }
        
        .stat-icon {
            font-size: 3.5rem;
            margin-bottom: 20px;
            opacity: 0.9;
        }
        
        .stat-number {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 10px;
            display: block;
        }
        
        .stat-label {
            font-size: 1.2rem;
            opacity: 0.95;
            font-weight: 500;
        }
        
        /* Footer */
        .footer {
            background: #0b2545;
            color: white;
            padding: 40px 0 20px;
            text-align: center;
        }
        
        .footer p {
            margin: 10px 0;
            opacity: 0.8;
        }
        
        .footer-social {
            margin: 20px 0;
        }
        
        .footer-social a {
            color: white;
            font-size: 1.5rem;
            margin: 0 15px;
            transition: all 0.3s ease;
        }
        
        .footer-social a:hover {
            color: #ff8f2f;
            transform: translateY(-3px);
        }
        
        /* Scroll Down Indicator */
        .scroll-indicator {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 3;
            animation: bounce 2s infinite;
        }
        
        .scroll-indicator i {
            font-size: 2rem;
            color: #6B7FD7;
        }
        
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0) translateX(-50%); }
            40% { transform: translateY(-20px) translateX(-50%); }
            60% { transform: translateY(-10px) translateX(-50%); }
        }
        
        /* Button styles matching login page */
        .btn-outline-primary {
            color: #6B7FD7 !important;
            border-color: #6B7FD7 !important;
            font-weight: 700 !important;
        }
        
        .btn-outline-primary:hover {
            background: #6B7FD7 !important;
            color: white !important;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1rem;
            }
            
            .hero-description {
                font-size: 1rem;
                padding: 20px;
            }
            
            .hero-logo {
                width: 120px;
                height: 120px;
            }
            
            .hero-logo i {
                font-size: 60px;
            }
            
            .login-btn {
                padding: 15px 40px;
                font-size: 1.1rem;
            }
            
            .section-title h2 {
                font-size: 2rem;
            }
            
            .stat-number {
                font-size: 2.5rem;
            }
            
            body {
                background-attachment: scroll;
            }
        }
        
        @media (max-width: 576px) {
            .hero-title {
                font-size: 2rem;
            }
            
            .stats-section {
                padding: 50px 0;
            }
        }
    </style>
</head>
<body>
    <div class="content-wrapper">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <i class="bi bi-hand-index-thumb"></i>
                    TUNAS
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#home">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tentang">Tentang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#statistik">Statistik</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-primary ms-2 px-4" href="#" onclick="handleLogin(); return false;">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="hero-section" id="home">
            <div class="container">
                <div class="hero-content">
                    <div class="hero-logo">
                        <i class="bi bi-hand-index-thumb"></i>
                    </div>
                    <h1 class="hero-title">TUNAS</h1>
                    <p class="hero-subtitle">Tunarungu Siap</p>
                    <div class="hero-description" id="tentang">
                        <p><strong>TUNAS</strong> merupakan website pelatihan persiapan kerja berbasis BISINDO untuk mendukung <strong>Employability</strong> yaitu pemahaman, keterampilan, keyakinan efikasi diri serta refleksi dan kesadaran belajar Siswa Tunarungu SMALB.</p>
                    </div>
                    <button class="login-btn" onclick="handleLogin()">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Masuk Sekarang
                    </button>
                </div>
            </div>
            <div class="scroll-indicator">
                <i class="bi bi-chevron-down"></i>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="stats-section" id="statistik">
            <div class="container">
                <div class="section-title">
                    <h2>Statistik Platform</h2>
                    <p>Data pencapaian TUNAS dalam mendukung pendidikan siswa tunarungu</p>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="stat-card">
                            <i class="bi bi-people-fill stat-icon"></i>
                            <span class="stat-number" id="userCount">0</span>
                            <div class="stat-label">Total Pengguna Aktif</div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="stat-card">
                            <i class="bi bi-journal-check stat-icon"></i>
                            <span class="stat-number" id="courseCount">0</span>
                            <div class="stat-label">Materi Pelatihan</div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="stat-card">
                            <i class="bi bi-trophy-fill stat-icon"></i>
                            <span class="stat-number" id="graduateCount">0</span>
                            <div class="stat-label">Siswa Lulus</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <div class="footer-social">
                    <a href="#"><i class="bi bi-envelope-fill"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-whatsapp"></i></a>
                </div>
                <p>&copy; 2024 TUNAS - Tunarungu Siap. All Rights Reserved.</p>
                <p>Platform Pelatihan Kerja Berbasis BISINDO untuk SMALB</p>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Counter animation
        function animateCounter(id, target, duration) {
            const element = document.getElementById(id);
            const start = 0;
            const increment = target / (duration / 16);
            let current = start;
            
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    element.textContent = target.toLocaleString();
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(current).toLocaleString();
                }
            }, 16);
        }

        // Intersection Observer untuk animasi counter
        const observerOptions = {
            threshold: 0.5
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter('userCount', 1247, 2000);
                    animateCounter('courseCount', 38, 2000);
                    animateCounter('graduateCount', 892, 2000);
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Observe stats section
        const statsSection = document.querySelector('.stats-section');
        observer.observe(statsSection);

        // Login handler
        function handleLogin() {
            alert('Mengarahkan ke halaman login...\n\nCatatan: Hubungkan dengan halaman login Anda.');
            // Ganti dengan URL halaman login Anda
             window.location.href = 'login.php';
        }

        // Hide scroll indicator on scroll
        window.addEventListener('scroll', function() {
            const scrollIndicator = document.querySelector('.scroll-indicator');
            if (window.scrollY > 100) {
                scrollIndicator.style.opacity = '0';
            } else {
                scrollIndicator.style.opacity = '1';
            }
        });
    </script>
</body>
</html>