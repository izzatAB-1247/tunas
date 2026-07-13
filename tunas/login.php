<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>TUNAS - Tunarungu Siap</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        /* Reset ringan */
        * { box-sizing: border-box; margin: 0; padding: 0; }
        html, body { height: 100%; }

        /* Body & background */
        body {
            font-family: 'Arial', sans-serif;
            min-height: 100vh;
            /* ganti path jika perlu: images/background.jpg */
            background-image: url('images/background.jpg');
            background-repeat: no-repeat;
            background-position: center top;
            background-size: cover;
            display: flex;
            flex-direction: column;
            color: #111;
        }

        /* overlay supaya teks terbaca di atas background */
        .bg-overlay {
            position: fixed;
            inset: 0;
            background: rgba(255,255,255,0.55); /* ubah opacity bila perlu */
            pointer-events: none;
            z-index: 0;
            backdrop-filter: blur(2px);
        }

        /* Container utama (konten di atas overlay) */
        .page {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 24px;
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
        }

        .logo-container { display: flex; flex-direction: column; gap:4px; }
        .logo { font-size: 36px; font-weight: 900; color: #0b2545; font-style: italic; letter-spacing: -1px; }
        .tagline { font-size: 12px; font-weight: 700; color: #0b2545; letter-spacing: 2px; }

        .contact-info { display:flex; gap:18px; align-items:center; font-weight:600; color:#0b2545; font-size:13px; }
        .icon { width:34px; height:34px; border-radius:8px; display:flex; align-items:center; justify-content:center; color:#fff; font-weight:bold; }
        .icon-email { background:#FFA500; }
        .icon-instagram { background: linear-gradient(45deg,#F58529,#DD2A7B,#8134AF); }
        .icon-whatsapp { background:#25D366; }

        /* Layout hero + sidebar/login */
        .main-content {
            display: flex;
            gap: 32px;
            align-items: center;
            justify-content: center;
            padding: 24px 0 60px 0;
        }

        /* Sidebar (tombol) */
        .sidebar {
            display:flex;
            flex-direction: column;
            gap:16px;
            min-width: 120px;
        }
        .menu-btn {
            padding: 12px 22px;
            border: none;
            border-radius: 28px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: transform .25s, box-shadow .25s;
            text-transform: uppercase;
            letter-spacing: .8px;
            box-shadow: 0 6px 14px rgba(11,37,69,0.08);
        }
        .menu-btn.guru { background:#6B7FD7; color:#fff; }
        .menu-btn.siswa { background:#7ED957; color:#fff; }
        .menu-btn.contact { background:#7BA3C4; color:#fff; }
        .menu-btn:hover { transform: translateX(6px); }

        /* Card login — dibuat compact & responsive */
        .login-container {
            background: linear-gradient(135deg, rgba(139,127,215,0.95) 0%, rgba(107,127,215,0.95) 100%);
            border-radius: 18px;
            padding: 28px;
            width: 360px;
            max-width: 92vw;
            box-shadow: 0 12px 30px rgba(0,0,0,0.12);
            border: 2px solid rgba(167,139,250,0.18);
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .login-title {
            color: #fff;
            font-size: 26px;
            font-weight: 800;
            margin-bottom: 6px;
            letter-spacing: 1px;
        }

        .form-group { margin-bottom: 10px; display:flex; flex-direction:column; gap:6px; }
        .form-label { color: #FFD54F; font-size: 12px; font-weight:700; text-transform:uppercase; }
        .form-input {
            padding: 10px 12px;
            border-radius: 10px;
            border: 1.5px solid rgba(255,255,255,0.25);
            background: rgba(255,255,255,0.06);
            color: #fff;
            font-size: 15px;
        }
        .form-input::placeholder { color: rgba(255,255,255,0.6); }
        .form-input:focus { outline:none; background: rgba(255,255,255,0.12); border-color: #FFC107; }

      

.login-btn:hover {
    background: #f2f2f2;
}


        .disclaimer { color: rgba(255,255,255,0.9); font-size: 12px; text-align:center; margin-top:6px; line-height:1.3; }

        /* Hero area (karakter + tangan + cards) */
        .hero-section {
            flex: 1 1 560px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 18px;
            padding: 6px 12px;
            max-width: 720px;
            width: 100%;
        }

        .illustration {
            position: relative;
            width: 460px;
            max-width: 92%;
            height: auto;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 18px;
        }

        /* gambar karakter (mengganti svg lama) */
        .character-img {
            width: 260px; /* ukuran default */
            max-width: 55%;
            height: auto;
            display: block;
            z-index: 2;
            border-radius: 12px;
            box-shadow: 0 12px 30px rgba(11,37,69,0.09);
            background: rgba(255,255,255,0.0);
        }

        /* Tangan animasi mengapung di pinggir — tetap digunakan */
        .hands {
            position: absolute;
            font-size: 56px;
            z-index: 3;
            animation: float 3.5s ease-in-out infinite;
            will-change: transform;
            text-shadow: 0 6px 10px rgba(0,0,0,0.08);
        }
        .hand1 { top: 6%; left: 2%; animation-delay: 0s; transform-origin:center; }
        .hand2 { top: 4%; right: 8%; animation-delay: .35s; }
        .hand3 { top: 32%; left: -2%; animation-delay: .7s; }
        .hand4 { top: 36%; right: 2%; animation-delay: 1.05s; }
        .hand5 { bottom: 16%; left: 6%; animation-delay: 1.4s; }
        .hand6 { bottom: 12%; right: 12%; animation-delay: 1.75s; }

        @keyframes float {
            0%,100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-18px) rotate(6deg); }
        }

        /* Cards di bawah hero */
    .feature-card {
    width: 280px;
    display: flex;
    flex-direction: row; /* pastikan isinya horizontal */
    align-items: center;
    background: #ffffff;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    margin: 10px;
    flex-shrink: 0; /* ← tambahan agar tidak turun ke bawah */
}


.feature-icon img {
    width: 55px;
    height: 55px;
    margin-right: 15px;
}

.feature-content h3 {
    font-size: 16px;
    font-weight: 700;
    margin: 0;
    color: #2d4e86;
}

.feature-content p {
    font-size: 12px;
    margin: 3px 0 10px;
    color: #6a6a6a;
}

.feature-btn {
    background: #6fa9ee;
    color: white;
    border: none;
    padding: 6px 16px;
    border-radius: 4px;
    font-size: 12px;
    cursor: pointer;
    transition: 0.2s;
}

.feature-btn:hover {
    background: #5d94d4;
}
.feature-container {
    display: flex;
    flex-direction: row;
    justify-content: center;
    gap: 20px;
    flex-wrap: nowrap; /* ← paksa jadi 1 baris */
}



        /* Responsiveness */
        @media (max-width: 980px) {
            .main-content { gap: 18px; padding: 18px 0 40px 0; }
            .sidebar { display:none; } /* sembunyikan sidebar pada layar sempit */
            .character-img { width: 220px; max-width: 48%; }
            .login-container { width: 340px; }
            .illustration { padding: 8px; }
        }

        @media (max-width: 640px) {
            .header { padding: 8px 4px; }
            .logo { font-size: 28px; }
            .main-content {
                flex-direction: column-reverse; /* form di atas karakter pada hp */
                gap: 12px;
                align-items: center;
            }
            .hero-section { padding: 6px; }
            .character-img { width: 180px; max-width: 70%; }
            .login-container { width: 92%; max-width: 420px; padding: 18px; }
            .hands { font-size: 42px; }
            .cards-container { flex-direction: column; gap:12px; }
        }
      .btn-orange {
    width: 100%;
    padding: 12px; /* sama seperti input */
    border-radius: 8px; /* sama seperti input */
    border: 2px solid rgba(255,255,255,0.3); /* sama seperti input */
    background: linear-gradient(135deg, #ff8f2f, #ff6a00);
    color: white;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-orange:hover {
    background: linear-gradient(135deg, #ff9e3f, #ff7a1a);
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(255, 109, 0, 0.42);
}

.contact-icon {
    font-size: 20px;
    margin-right: 8px;
    vertical-align: middle;
}
.contact-icon {
    color: #ff7a1a;
}



        /* small visual tweaks */
        .notification-badge, .user-badge, .notification-icon { display:none; } /* opsional, sembunyikan agar simpel */
    </style>
</head>
<body>
    <!-- overlay agar background tetap terbaca -->
    <div class="bg-overlay" aria-hidden="true"></div>

    <div class="page">
        <!-- Header -->
        <header class="header" role="banner">
            <div class="logo-container">
                <div class="logo">TUNAS</div>
                <div class="tagline">TUNARUNGU SIAP</div>
            </div>

            <div class="contact-info" aria-label="Kontak">
               <p><i class="bi bi-envelope-fill contact-icon"></i> tunas@gmail.co</p>
<p><i class="bi bi-instagram contact-icon"></i> @tunassiap</p>
<p><i class="bi bi-whatsapp contact-icon"></i> 08xxxxxxxxxx</p>

            </div>
        </header>

        <!-- Main -->
        <main class="main-content" role="main">
          

            <!-- Login form (tetap kompak) -->
            <section class="login-container" aria-labelledby="login-title">
                <h2 id="login-title" class="login-title">LOGIN</h2>

                <form id="loginForm" action="proses_login.php" method="POST">
                    <div class="form-group">
                        <label class="form-label" for="email">Email</label>
                        <input id="email" type="email" name="email" class="form-input" placeholder="Masukkan email Anda" required />
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <input id="password" type="password" name="password" class="form-input" placeholder="Masukkan password Anda" required />
                    </div>

                    <button type="submit" class="btn-orange">LOGIN</button>

                    <p class="disclaimer">Belum punya akun? <a href="register.php" style="color:#FFD54F; text-decoration:underline; cursor:pointer;" onclick="toggleRegister()">Daftar di sini</a></p>
                </form>
            </section>

            <!-- Hero (karakter & tangan) -->
            <section class="hero-section" aria-label="Hero">
                <div class="illustration" role="img" aria-label="Ilustrasi karakter">
                    <!-- tangan animasi tetap ada di pinggir -->
                    <div class="hands hand1">👌</div>
                    <div class="hands hand2">🤘</div>
                    <div class="hands hand3">👆</div>
                    <div class="hands hand4">✌️</div>
                    <div class="hands hand5">👍</div>
                    <div class="hands hand6">🖐️</div>

                    <!-- gunakan path images/character.png (ganti nama jika perlu) -->
                    <img src="images/character.png" alt="Karakter TUNAS" class="character-img" />
                </div>

                <!-- Cards (contoh) -->
                <div class="feature-container">
    <div class="feature-card">
        <div class="feature-icon">
            <img src="assets/education.png" alt="Education">
        </div>
        <div class="feature-content">
            <h3>EDUCATION</h3>
            <p>Vocasional</p>
            <button class="feature-btn">LEARN MORE</button>
        </div>
    </div>

    <div class="feature-card">
        <div class="feature-icon">
            <img src="assets/comunity.png" alt="Community">
        </div>
        <div class="feature-content">
            <h3>COMMUNITY</h3>
            <p>Komunitas Tunarungu</p>
            <button class="feature-btn">LEARN MORE</button>
        </div>
    </div>
</div>

            </section>
        </main>
    </div>

    <script>
        // Form sederhana (tetap prevent default)
        document.getElementById('loginForm').addEventListener('submit', function(e){
            alert('Login berhasil! Selamat datang di TUNAS 🎉');
        });
    </script>
</body>
</html>
