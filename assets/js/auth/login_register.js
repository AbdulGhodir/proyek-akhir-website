document.addEventListener('DOMContentLoaded', () => {
    const card = document.querySelector('.card-login');
    const swapToLeftBtn = document.querySelector('#tombol-daftar');
    const swapToRightBtn = document.querySelector('#tombol-masuk');
    const kotakBiru = document.querySelector('.kotak-biru');
    
    const pilihanUser = document.querySelector('#pilihan-user');
    const pilihanEO = document.querySelector('#pilihan-eo');
    const registerContent = document.querySelector('.register-form');
    const roleInput = document.querySelector('#role_input');

    let swapped = false;

    const urlParams = new URLSearchParams(window.location.search);
    
    if (urlParams.get('mode') === 'daftar') {
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
        roleInput.value = 'User';
        pilihanUser.classList.add('terpilih');
        pilihanEO.classList.remove('terpilih');
        registerContent.classList.remove('eo');                
    })
    
    pilihanEO.addEventListener('click', () => {
        roleInput.value = 'EO';
        pilihanEO.classList.add('terpilih');
        pilihanUser.classList.remove('terpilih');
        registerContent.classList.add('eo');                
    })

    const notifikasi = document.querySelector('.notifikasi');
    
    function tampilkanNotifikasi(pesan, tipe) {
        const icon = tipe === 'sukses' ? 'check-circle' : 'alert-circle';
        const warna = tipe === 'sukses' ? 'green' : 'red';

        notifikasi.innerHTML = `
            <i class="icon-notif" data-lucide="${icon}"></i>
            <span class="notif-message">${pesan}</span>
        `;

        notifikasi.style.color = warna;
        notifikasi.style.borderColor = warna;
        notifikasi.classList.add('active');

        lucide.createIcons();
        
        setTimeout(() => {
            notifikasi.classList.remove('active');
        }, 2000);
    }
    
    const formRegistrasi = document.getElementById('form-registrasi');
    const passwordInput = document.getElementById('password-daftar');
    const konfirmasiPasswordInput = document.getElementById('konfirmasi-password-daftar');

    formRegistrasi.addEventListener('submit', (e) => {
        e.preventDefault();
        const submitBtn = document.getElementById('btn-daftar');

        if (passwordInput.value.length < 6) {
            tampilkanNotifikasi('Password minimal terdiri dari 6 karakter', 'error');
            submitBtn.disabled = true;

            setTimeout(() => {
                submitBtn.disabled = false;
            }, 2000);
            return;
        }

        if (passwordInput.value !== konfirmasiPasswordInput.value) {
            tampilkanNotifikasi('Password tidak cocok', 'error');
            submitBtn.disabled = true;

            setTimeout(() => {
                submitBtn.disabled = false;
            }, 2000);
            return;
        }

        submitBtn.disabled = true;
        lucide.createIcons();

        const dataForm = new FormData(formRegistrasi);
        dataForm.append('daftar', 'true');

        fetch(BASEURL + '/app/controllers/auth/register.php', {
            method: 'POST',
            body: dataForm
        })
        .then(response => response.text())
        .then(hasil => {
            if (hasil.trim() === 'email_terdaftar') {
                tampilkanNotifikasi('Email sudah terdaftar!', 'error');
                setTimeout(() => {
                    submitBtn.disabled = false;
                }, 2000);
            } else if (hasil.trim() === 'sukses') {
                tampilkanNotifikasi('Pendaftaran berhasil! Silakan masuk', 'sukses');
                formRegistrasi.reset();
                
                setTimeout(() => {
                    swapToRightBtn.click();
                    submitBtn.disabled = false;
                }, 2000);
            } else {
                tampilkanNotifikasi('Terjadi kesalahan pada sistem', 'error');

                setTimeout(() => {
                    submitBtn.disabled = false;
                }, 2000);
            }
        })
    })

    const formLogin = document.getElementById('form-login');

    formLogin.addEventListener('submit', (e) => {
        e.preventDefault();
        const submitBtn = document.getElementById('btn-masuk');
        submitBtn.disabled = true;

        const dataForm = new FormData(formLogin);
        dataForm.append('masuk', 'true');

        fetch(BASEURL + '/app/controllers/auth/login.php', {
            method: 'POST',
            body: dataForm
        })
        .then(response => response.text())
        .then(hasil => {
            if (hasil.trim() === 'login_berhasil_user') {
                tampilkanNotifikasi('Login berhasil, Selamat Datang!', 'sukses');
                setTimeout(() => {
                    submitBtn.disabled = false;
                    window.location.href = BASEURL + '/app/views/user/dashboard.php';
                }, 2000);
            } else if (hasil.trim() === 'login_berhasil_eo') {
                tampilkanNotifikasi('Login berhasil, Selamat Datang Event Organizer!', 'sukses');
                setTimeout(() => {
                    submitBtn.disabled = false;
                    window.location.href = BASEURL + '/app/views/eo/dashboard.php';
                }, 2000);
            } else if (hasil.trim() === 'login_berhasil_admin') {
                tampilkanNotifikasi('Login berhasil, Selamat Datang Admin!', 'sukses');
                setTimeout(() => {
                    submitBtn.disabled = false;
                    window.location.href = BASEURL + '/app/views/admin/index.php';
                }, 2000);
            } else if (hasil.trim() === 'login_gagal') {
                tampilkanNotifikasi('Email atau Password salah!', 'error');
                setTimeout(() => {
                    submitBtn.disabled = false;
                }, 2000);
            }
        })
    })
        
})