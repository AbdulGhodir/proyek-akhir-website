<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $mode == 'register' ? 'Register Page' : 'Login Page'; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/global.css">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="login-register-page preload">
    <section class="card-login <?= $mode == 'register' ? 'swapped' : ''; ?>">
        <div class="login-form">
            <span class="title">Login</span>
            
            <form id="form-login" class="form">
                <div class="input">
                    <label>Email</label>
                    <div class="input-field">
                        <i data-lucide="mail" class="icon-field" style="width: 1.25rem; height: 1.25rem; color: gray;"></i>
                        <input type="email" name="email" placeholder="Masukkan Email" required>
                    </div>
                </div>
    
                <div class="input">
                    <label>Password</label>
                    <div class="input-field">
                        <i data-lucide="lock" class="icon-field" style="width: 1.25rem; height: 1.25rem; color: gray;"></i>
                        <input id="password-login" type="password" name="password" placeholder="Masukkan Password" required>
                        <i data-lucide="eye" id="password-icon-login" class="icon-eye-password" style="width: 1.25rem; height: 1.25rem; color: gray;" onclick="tampilkanPassword('password-login', 'password-icon-login')"></i>
                    </div>
                </div>

                <div class="remember-forgot">
                    <div class="remember-me" style="visibility: hidden;">
                        <input type="checkbox" style="cursor: pointer;">
                        <span>Ingat Saya</span>
                    </div>
    
                    <a href="<?= BASEURL; ?>/app/controllers/auth/lupa_password.php">Lupa Password</a>
                </div>
                <button id="btn-masuk" type="submit" class="submit-button">Masuk</button>
                <p class="mobile-swap-mode" style="display: none;">Belum punya akun? <a href="<?= BASEURL; ?>/app/controllers/auth/register.php">Daftar</a></p>
            </form>
        </div>

        <div class="register-form">
            <span class="title">Register</span>

            <div class="daftar-sebagai">
                <span>Daftar Sebagai</span>
                <div class="pilihan-role">
                    <div id="pilihan-user" class="pilihan terpilih">
                        <i data-lucide="user" style="width: 1.5rem; height: 1.5rem;"></i>
                        <span>Pengguna Umum</span>
                    </div>
                    <div id="pilihan-eo" class="pilihan">
                        <i data-lucide="building-2" style="width: 1.5rem; height: 1.5rem;"></i>
                        <span>Event Organizer</span>
                    </div>
                </div>
            </div>
            
            <form id="form-registrasi" class="form">
                <input type="hidden" name="role" value="user" id="role_input">

                <div class="input">
                    <label>Nama Lengkap</label>
                    <div class="input-field">
                        <i data-lucide="user" class="icon-field" style="width: 1.25rem; height: 1.25rem; color: gray;"></i>
                        <input type="text" name="nama" placeholder="Masukkan Nama Anda" required>
                    </div>
                </div>

                <div class="row-input">
                    <div class="input nama-instansi">
                        <label>Nama Instansi / Organisasi</label>
                        <div class="input-field">
                            <i data-lucide="building-2" class="icon-field" style="width: 1.25rem; height: 1.25rem; color: gray;"></i>
                            <input type="text" name="nama_organisasi" placeholder="Himakom Unila">
                        </div>
                    </div>
                    
                    <div class="input">
                        <label>Email</label>
                        <div class="input-field">
                            <i data-lucide="mail" class="icon-field" style="width: 1.25rem; height: 1.25rem; color: gray;"></i>
                            <input type="email" name="email" placeholder="nama@example.com" required>
                        </div>
                    </div>
                </div>

    
                <div class="password-container">
                    <div class="row-input">
                        <div class="input">
                            <label>Password</label>
                            <div class="input-field">
                                <i data-lucide="lock" class="icon-field" style="width: 1.25rem; height: 1.25rem; color: gray;"></i>
                                <input id="password-daftar" type="password" name="password" placeholder="••••••••••" required>
                                <i data-lucide="eye" id="password-icon-daftar" class="icon-eye-password" style="width: 1.25rem; height: 1.25rem; color: gray;" onclick="tampilkanPassword('password-daftar', 'password-icon-daftar')"></i>
                            </div>
                        </div>
                        <div class="input">
                            <label>Konfirmasi Password</label>
                            <div class="input-field">
                                <i data-lucide="lock" class="icon-field" style="width: 1.25rem; height: 1.25rem; color: gray;"></i>
                                <input id="konfirmasi-password-daftar" type="password" name="konfirmasi_password" placeholder="••••••••••" required>
                                <i data-lucide="eye" id="konfirmasi-password-icon-daftar" class="icon-eye-password" style="width: 1.25rem; height: 1.25rem; color: gray;" onclick="tampilkanPassword('konfirmasi-password-daftar', 'konfirmasi-password-icon-daftar')"></i>
                            </div>
                        </div>
                    </div>
                </div>
    
                <button id="btn-daftar" class="submit-button" type="submit">Daftar Sekarang</button>
                <p class="mobile-swap-mode" style="display: none;">Sudah punya akun? <a href="<?= BASEURL; ?>/app/controllers/auth/login.php">Masuk</a></p>
            </form>
        </div>

        <div class="kotak-biru"></div>
        
        <div class="left-content">
            <div class="text-title">
                <span class="title">Selamat Datang Kembali!</span>
                <p>Sudah punya akun? Masuk dengan akun Anda untuk melanjutkan.</p>
            </div>
            <button id="tombol-masuk" class="swap-button">Masuk</button>
        </div>
        
        <div class="right-content">
            <div class="text-title">
                <span class="title">Selamat Datang!</span>
                <p>Belum punya akun? Daftar sekarang dan mulai gunakan semua fitur dengan mudah.</p>
            </div>
            <button id="tombol-daftar" class="swap-button">Daftar</button>
        </div>

        <div class="notifikasi"></div>
    </section>

    <script src="<?= BASEURL; ?>/assets/js/global.js"></script>
    <script>const BASEURL = "<?= BASEURL; ?>";</script>
    <script src="<?= BASEURL; ?>/assets/js/auth/login_register.js"></script>
</body>
</html>