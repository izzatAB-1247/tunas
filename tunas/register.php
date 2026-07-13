<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Register - TUNAS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        /* Reset ringan */
        * { box-sizing: border-box; margin: 0; padding: 0; }
        html, body { height: 100%; }

        /* Body & background */
        body {
            font-family: 'Arial', sans-serif;
            min-height: 100vh;
            background-image: url('images/background.jpg');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            background-attachment: fixed;
            display: flex;
            flex-direction: column;
            color: #111;
        }

        /* overlay supaya teks terbaca di atas background */
        .bg-overlay {
            position: fixed;
            inset: 0;
            background: rgba(255,255,255,0.55);
            pointer-events: none;
            z-index: 0;
            backdrop-filter: blur(2px);
        }

        /* Container utama */
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
            margin-bottom: 20px;
        }

        .logo-container { display: flex; flex-direction: column; gap:4px; }
        .logo { font-size: 36px; font-weight: 900; color: #0b2545; font-style: italic; letter-spacing: -1px; }
        .tagline { font-size: 12px; font-weight: 700; color: #0b2545; letter-spacing: 2px; }

        .back-btn {
            padding: 10px 24px;
            background: rgba(255,255,255,0.8);
            border: 2px solid #6B7FD7;
            border-radius: 25px;
            color: #6B7FD7;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .back-btn:hover {
            background: #6B7FD7;
            color: white;
            transform: translateX(-3px);
        }

        /* Main Content */
        .main-content {
            display: flex;
            gap: 40px;
            align-items: center;
            justify-content: center;
            padding: 20px 0 60px 0;
            flex-wrap: wrap;
            min-height: calc(100vh - 200px);
        }

        /* Left Section - Role & Illustration */
        .left-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 30px;
        }

        /* Role Selection Cards */
        .role-selection {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .role-card {
            background: rgba(255,255,255,0.9);
            border: 3px solid transparent;
            border-radius: 20px;
            padding: 30px;
            width: 220px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
        }

        .role-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }

        .role-card.active.guru {
            border-color: #6B7FD7;
            background: linear-gradient(135deg, rgba(107,127,215,0.15), rgba(107,127,215,0.05));
        }

        .role-card.active.siswa {
            border-color: #7ED957;
            background: linear-gradient(135deg, rgba(126,217,87,0.15), rgba(126,217,87,0.05));
        }

        .role-icon {
            font-size: 60px;
            margin-bottom: 15px;
        }

        .role-card.guru .role-icon { color: #6B7FD7; }
        .role-card.siswa .role-icon { color: #7ED957; }

        .role-title {
            font-size: 20px;
            font-weight: 700;
            color: #0b2545;
            margin-bottom: 8px;
        }

        .role-desc {
            font-size: 13px;
            color: #666;
        }

        /* Register Container */
        .register-container {
            background: linear-gradient(135deg, rgba(139,127,215,0.95) 0%, rgba(107,127,215,0.95) 100%);
            border-radius: 18px;
            padding: 30px;
            width: 480px;
            max-width: 92vw;
            box-shadow: 0 12px 30px rgba(0,0,0,0.12);
            border: 2px solid rgba(167,139,250,0.18);
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .register-title {
            color: #fff;
            font-size: 26px;
            font-weight: 800;
            margin-bottom: 5px;
            letter-spacing: 1px;
            text-align: center;
        }

        .register-subtitle {
            color: rgba(255,255,255,0.9);
            font-size: 13px;
            text-align: center;
            margin-bottom: 15px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .form-group { 
            margin-bottom: 10px; 
            display:flex; 
            flex-direction:column; 
            gap:5px; 
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-label { 
            color: #FFD54F; 
            font-size: 12px; 
            font-weight:700; 
            text-transform:uppercase; 
        }

        .form-input {
            padding: 10px 12px;
            border-radius: 8px;
            border: 2px solid rgba(255,255,255,0.3);
            background: rgba(255,255,255,0.06);
            color: #fff;
            font-size: 14px;
        }

        .form-input::placeholder { color: rgba(255,255,255,0.6); }
        .form-input:focus { 
            outline:none; 
            background: rgba(255,255,255,0.12); 
            border-color: #FFC107; 
        }

        .form-select {
            padding: 10px 12px;
            border-radius: 8px;
            border: 2px solid rgba(255,255,255,0.3);
            background: rgba(255,255,255,0.06);
            color: #fff;
            font-size: 14px;
            cursor: pointer;
        }

        .form-select option {
            background: #6B7FD7;
            color: white;
        }

        .btn-orange {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 2px solid rgba(255,255,255,0.3);
            background: linear-gradient(135deg, #ff8f2f, #ff6a00);
            color: white;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 8px;
        }

        .btn-orange:hover {
            background: linear-gradient(135deg, #ff9e3f, #ff7a1a);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(255, 109, 0, 0.42);
        }

        .btn-orange:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }

        .disclaimer { 
            color: rgba(255,255,255,0.9); 
            font-size: 12px; 
            text-align:center; 
            margin-top:8px; 
            line-height:1.4; 
        }

        .disclaimer a {
            color: #FFD54F;
            text-decoration: underline;
            cursor: pointer;
        }

        /* Illustration */
        .illustration-container {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .character-img {
            width: 300px;
            max-width: 90%;
            height: auto;
            border-radius: 12px;
            box-shadow: 0 12px 30px rgba(11,37,69,0.09);
            animation: float 3.5s ease-in-out infinite;
        }

        @keyframes float {
            0%,100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }

        .hands {
            position: absolute;
            font-size: 50px;
            animation: float 3.5s ease-in-out infinite;
            text-shadow: 0 6px 10px rgba(0,0,0,0.08);
        }

        .hand1 { top: 5%; left: 10%; animation-delay: 0s; }
        .hand2 { top: 5%; right: 10%; animation-delay: .35s; }
        .hand3 { bottom: 20%; left: 5%; animation-delay: .7s; }
        .hand4 { bottom: 20%; right: 5%; animation-delay: 1.05s; }

        /* Password strength indicator */
        .password-strength {
            height: 4px;
            background: rgba(255,255,255,0.2);
            border-radius: 2px;
            margin-top: 6px;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            width: 0%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .strength-weak { background: #ff4444; width: 33%; }
        .strength-medium { background: #ffbb33; width: 66%; }
        .strength-strong { background: #00C851; width: 100%; }

        /* Responsive */
        @media (max-width: 980px) {
            .main-content { 
                gap: 24px;
                flex-direction: column;
            }
            .register-container { width: 100%; max-width: 500px; }
            .left-section {
                order: 2;
            }
            .register-container {
                order: 1;
            }
        }

        @media (max-width: 640px) {
            .header { flex-direction: column; gap: 12px; text-align: center; }
            .form-row { grid-template-columns: 1fr; }
            .character-img { width: 220px; }
            .hands { font-size: 38px; }
            .role-selection { gap: 16px; }
            .role-card { width: 160px; padding: 20px; }
            .role-icon { font-size: 45px; }
            .left-section { gap: 20px; }
        }
    </style>
</head>
<body>
    <div class="bg-overlay" aria-hidden="true"></div>

    <div class="page">
        <!-- Header -->
        <header class="header" role="banner">
            <div class="logo-container">
                <div class="logo">TUNAS</div>
                <div class="tagline">TUNARUNGU SIAP</div>
            </div>
            <a href="login.php" class="back-btn">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </header>

        <!-- Main Content -->
        <main class="main-content" role="main">
            <!-- Role Selection & Illustration -->
            <section class="left-section">
                <div class="role-selection">
                    <div class="role-card guru" onclick="selectRole('guru')" id="guruCard">
                        <div class="role-icon">👨‍🏫</div>
                        <div class="role-title">GURU</div>
                        <div class="role-desc">Pendidik & Pembimbing</div>
                    </div>
                    <div class="role-card siswa" onclick="selectRole('siswa')" id="siswaCard">
                        <div class="role-icon">🎓</div>
                        <div class="role-title">SISWA</div>
                        <div class="role-desc">Peserta Didik</div>
                    </div>
                </div>

                <div class="illustration-container" aria-label="Ilustrasi">
                    <div class="hands hand1">👌</div>
                    <div class="hands hand2">✌️</div>
                    <div class="hands hand3">👍</div>
                    <div class="hands hand4">🖐️</div>
                    <img src="images/character.png" alt="Karakter TUNAS" class="character-img" />
                </div>
            </section>
            <!-- Register Form -->
            <section class="register-container" aria-labelledby="register-title">
                <h2 id="register-title" class="register-title">DAFTAR AKUN</h2>
                <p class="register-subtitle" id="roleSubtitle">Pilih peran Anda terlebih dahulu</p>

              <form id="registerForm" action="proses_register.php" method="POST">
                    <input type="hidden" id="roleInput" name="role" required>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="namaDepan">Nama Depan</label>
                            <input id="namaDepan" name="namaDepan" type="text" class="form-input" placeholder="Nama depan" required />
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="namaBelakang">Nama Belakang</label>
                            <input id="namaBelakang" name="namaBelakang" type="text" class="form-input" placeholder="Nama belakang" required />
                        </div>
                    </div>

                    <div class="form-group full-width">
                        <label class="form-label" for="email">Email</label>
                        <input id="email" type="email"  name="email" class="form-input" placeholder="nama@email.com" required />
                    </div>

                    <div class="form-group full-width" id="nip-group" style="display: none;">
                        <label class="form-label" for="nip">NIP (Nomor Induk Pegawai)</label>
                        <input id="nip" type="text" name="nip" class="form-input" placeholder="Masukkan NIP" />
                    </div>

                    <div class="form-group full-width" id="nis-group" style="display: none;">
                        <label class="form-label" for="nis">NIS (Nomor Induk Siswa)</label>
                        <input id="nis" type="text" name="nis" class="form-input" placeholder="Masukkan NIS" />
                    </div>

                    <div class="form-group full-width" id="kelas-group" style="display: none;">
                        <label class="form-label" for="kelas">Kelas</label>
                        <select id="kelas" name="kelas" class="form-select">
                            <option value="">Pilih Kelas</option>
                            <option value="10">Kelas 10</option>
                            <option value="11">Kelas 11</option>
                            <option value="12">Kelas 12</option>
                        </select>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="password">Password</label>
                            <input id="password" type="password" name="password"class="form-input" placeholder="Min. 8 karakter" required onkeyup="checkPasswordStrength()" />
                            <div class="password-strength">
                                <div class="password-strength-bar" id="strengthBar"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="confirmPassword">Konfirmasi Password</label>
                            <input id="confirmPassword" type="password" name="confirmPassword" class="form-input" placeholder="Ulangi password" required />
                        </div>
                    </div>

                    <div class="form-group full-width">
                        <label class="form-label" for="telepon">No. Telepon</label>
                        <input id="telepon" type="tel"  name="telepon" class="form-input" placeholder="08xxxxxxxxxx" required />
                    </div>

                    <button type="submit" class="btn-orange" id="submitBtn" disabled>
                        <i class="bi bi-person-plus-fill"></i> DAFTAR SEKARANG
                    </button>

                    <p class="disclaimer">
                        Sudah punya akun? <a href="login.php">Login di sini</a>
                    </p>
                </form>
            </section>
        </main>
    </div>

    <script>
        let selectedRole = '';

        // Select Role
        function selectRole(role) {
            selectedRole = role;
            document.getElementById('roleInput').value = role;
            
            // Update UI
            document.getElementById('guruCard').classList.remove('active');
            document.getElementById('siswaCard').classList.remove('active');
            document.getElementById(role + 'Card').classList.add('active');

            // Update subtitle
            const subtitle = role === 'guru' ? 'Daftar sebagai Guru' : 'Daftar sebagai Siswa';
            document.getElementById('roleSubtitle').textContent = subtitle;

            // Show/hide fields based on role
            if (role === 'guru') {
                document.getElementById('nip-group').style.display = 'flex';
                document.getElementById('nis-group').style.display = 'none';
                document.getElementById('kelas-group').style.display = 'none';
                document.getElementById('nip').required = true;
                document.getElementById('nis').required = false;
                document.getElementById('kelas').required = false;
            } else {
                document.getElementById('nip-group').style.display = 'none';
                document.getElementById('nis-group').style.display = 'flex';
                document.getElementById('kelas-group').style.display = 'flex';
                document.getElementById('nip').required = false;
                document.getElementById('nis').required = true;
                document.getElementById('kelas').required = true;
            }

            // Enable submit button
            document.getElementById('submitBtn').disabled = false;
        }

        // Password strength checker
        function checkPasswordStrength() {
            const password = document.getElementById('password').value;
            const strengthBar = document.getElementById('strengthBar');
            
            strengthBar.className = 'password-strength-bar';
            
            if (password.length === 0) {
                strengthBar.style.width = '0%';
            } else if (password.length < 6) {
                strengthBar.classList.add('strength-weak');
            } else if (password.length < 10) {
                strengthBar.classList.add('strength-medium');
            } else {
                strengthBar.classList.add('strength-strong');
            }
        }

        // Form submission
        document.getElementById('registerForm').addEventListener('submit', function(e) {
          

            if (!selectedRole) {
                alert('Silakan pilih peran Anda terlebih dahulu!');
                return;
            }

            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            if (password !== confirmPassword) {
                alert('Password tidak cocok! Silakan periksa kembali.');
                return;
            }

            if (password.length < 8) {
                alert('Password minimal 8 karakter!');
                return;
            }

            const formData = {
                role: selectedRole,
                namaDepan: document.getElementById('namaDepan').value,
                namaBelakang: document.getElementById('namaBelakang').value,
                email: document.getElementById('email').value,
                telepon: document.getElementById('telepon').value
            };

            if (selectedRole === 'guru') {
                formData.nip = document.getElementById('nip').value;
            } else {
                formData.nis = document.getElementById('nis').value;
                formData.kelas = document.getElementById('kelas').value;
            }

            console.log('Data Registrasi:', formData);
            alert('Registrasi berhasil! Selamat datang di TUNAS 🎉\n\nSilakan login dengan akun Anda.');
             window.location.href = 'login.php';
        });
    </script>
</body>
</html>