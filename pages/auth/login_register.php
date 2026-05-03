<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/global.css">
    <link rel="stylesheet" href="../../assets/css/auth/login_register.css">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="preload">
    <section class="card-login">
        <div class="login-form">
            <span class="title">Login</span>
            
            <form class="form">
                <div class="input">
                    <label>Email</label>
                    <div class="input-field">
                        <i data-lucide="mail" class="icon-field" style="width: 1.25rem; height: 1.25rem; color: gray;"></i>
                        <input type="email" placeholder="Masukkan Email">
                    </div>
                </div>
    
                <div class="input">
                    <label>Password</label>
                    <div class="input-field">
                        <i data-lucide="lock" class="icon-field" style="width: 1.25rem; height: 1.25rem; color: gray;"></i>
                        <input type="password" placeholder="Masukkan Password">
                    </div>
                </div>

                <div class="remember-forgot">
                    <div class="remember-me">
                        <input type="checkbox" style="cursor: pointer;">
                        <span>Ingat Saya</span>
                    </div>
    
                    <a href="">Lupa Password</a>
                </div>
                <a href="../eo/dashboard.php" class="submit-button">Masuk</a>
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
            
            <form class="form">
                <div class="input">
                    <label>Nama Lengkap</label>
                    <div class="input-field">
                        <i data-lucide="user" class="icon-field" style="width: 1.25rem; height: 1.25rem; color: gray;"></i>
                        <input type="text" placeholder="Masukkan Nama Anda">
                    </div>
                </div>
                
                <div class="input">
                    <label>Email</label>
                    <div class="input-field">
                        <i data-lucide="mail" class="icon-field" style="width: 1.25rem; height: 1.25rem; color: gray;"></i>
                        <input type="email" placeholder="nama@example.com">
                    </div>
                </div>
    
                <div class="input-password">
                    <div class="input">
                        <label>Password</label>
                        <div class="input-field">
                            <i data-lucide="lock" class="icon-field" style="width: 1.25rem; height: 1.25rem; color: gray;"></i>
                            <input type="password" placeholder="••••••••••">
                        </div>
                    </div>
                    <div class="input">
                        <label>Konfirmasi Password</label>
                        <div class="input-field">
                            <i data-lucide="lock" class="icon-field" style="width: 1.25rem; height: 1.25rem; color: gray;"></i>
                            <input type="password" placeholder="••••••••••">
                        </div>
                    </div>
                </div>
    
                <a href="../eo/dashboard.php" class="submit-button">Daftar Sekarang</a>
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
    </section>

    <script src="../../assets/js/global.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const card = document.querySelector('.card-login');
            const swapToLeftBtn = document.querySelector('#tombol-daftar');
            const swapToRightBtn = document.querySelector('#tombol-masuk');
            const kotakBiru = document.querySelector('.kotak-biru');
            
            const pilihanUser = document.querySelector('#pilihan-user');
            const pilihanEO = document.querySelector('#pilihan-eo');

            let swapped = false;

            const mode = new URLSearchParams(window.location.search).get('mode');
            
            if (mode === 'daftar') {
                card.classList.add('swapped');
                kotakBiru.classList.add('swapped');
                swapped = true;
            }

            setTimeout(() => {
                document.body.classList.remove('preload');
            }, 100);

            swapToLeftBtn.addEventListener('click', () => {
                if (!swapped) {
                    window.history.pushState({}, '', '?mode=daftar');
                    card.classList.add('animated-left');
                    card.classList.add('swapped');
                    
                    setTimeout(() => {
                        card.classList.remove('animated-left');
                        kotakBiru.classList.add('swapped');
                        
                        swapped = true;
                    }, 1400);
                }
            })
            
            swapToRightBtn.addEventListener('click', () => {
                if (swapped) {
                    window.history.pushState({}, '', window.location.pathname);
                    card.classList.add('animated-right');
                    card.classList.remove('swapped');
                    
                    setTimeout(() => {
                        card.classList.remove('animated-right');
                        kotakBiru.classList.remove('swapped');
                        
                        swapped = false;
                    }, 1400);
                }
            })

            pilihanUser.addEventListener('click', () => {
                pilihanUser.classList.add('terpilih');
                pilihanEO.classList.remove('terpilih');
            })

            pilihanEO.addEventListener('click', () => {
                pilihanEO.classList.add('terpilih');
                pilihanUser.classList.remove('terpilih');
            })
        })

    </script>
</body>
</html>