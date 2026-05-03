<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Pendaftar</title>
    <link rel="stylesheet" href="../../assets/css/global.css">
    <link rel="stylesheet" href="../../assets/css/eo/verifikasi.css">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>
    <nav>
        <div class="top-navbar">
            <div class="logo">
                <img src="../../assets/images/logo.png" alt="" style="width: 1.5rem; height: 1.5rem; object-fit: cover;">
                <span>Eventify</span>
            </div>
            
            <div class="menu">
                <div class="menu-utama">
                    <span>Menu Utama</span>
                    <a href="dashboard.php" class="menu-item">
                        <i class="icon-menu" data-lucide="layout-dashboard"></i>
                        Dasboard
                    </a>

                    <a href="event.php" class="menu-item">
                        <i class="icon-menu" data-lucide="calendar-plus"></i>
                        Manajemen Event
                    </a>
                </div>
                
                <div class="menu-pendaftar">
                    <span>Pendaftaran & Pembayaran</span>
                    <a href="verifikasi.php" class="menu-item active">
                        <i class="icon-menu" data-lucide="badge-check"></i>
                        Verifikasi Pendaftar
                    </a>
                </div>
            </div>
        </div>

        <div class="bottom-navbar">
            <div class="akun">
                <span class="profile-akun">A</span>
                <div class="info-akun">
                    <span class="nama">Abdul Ghodir</span>
                    <span class="email">eo@eventify.com</span>
                </div>
            </div>

            <div class="logout">
                <a href="/index.php">
                    <i data-lucide="log-out" style="width: 1rem; height: 1rem;"></i>
                    <span class="teks">Keluar</span>
                </a>
            </div>
        </div>
    </nav>

    <section>
        <div class="header">
            <div class="header-title">
                <span>Verifikasi Pendaftar</span>
                <span>Verifikasi pendaftaran dan pembayaran</span>
            </div>

            <select class="filter-event" name="filter-event" id="filter-event">
                <option value="">Semua Event</option>
                <option value="">Webinar Vibe Coding</option>
                <option value="">Seminar Hasil</option>
                <option value="">Konser Naruto Shippuden</option>
            </select>
        </div>

        <div class="daftar-pendaftar">
            <table>
                <thead>
                    <tr>
                        <th>Pendaftar</th>
                        <th>Event</th>
                        <th>Tanggal Daftar</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <span>Abdul Somad</span>
                            <span>abdul@email.com</span>
                        </td>
                        <td>Webinar Coding</td>
                        <td>Senin, 02 Juni 2025<br>09.00 WIB</td>
                        <td>
                            <span class="status confirmed">Terverifikasi</span>
                        </td>
                        <td><button class="lihat-jawaban">Lihat Jawaban</button></td>
                    </tr>
                    <tr>
                        <td>
                            <span>Abdul Somad</span>
                            <span>abdul@email.com</span>
                        </td>
                        <td>Webinar Coding</td>
                        <td>Senin, 02 Juni 2025<br>09.00 WIB</td>
                        <td>
                            <span class="status confirmed">Terverifikasi</span>
                        </td>
                        <td><button class="lihat-jawaban">Lihat Jawaban</button></td>
                    </tr>
                    <tr>
                        <td>
                            <span>Abdul Somad</span>
                            <span>abdul@email.com</span>
                        </td>
                        <td>Webinar Coding</td>
                        <td>Senin, 02 Juni 2025<br>09.00 WIB</td>
                        <td>
                            <span class="status confirmed">Terverifikasi</span>
                        </td>
                        <td><button class="lihat-jawaban">Lihat Jawaban</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <div class="overlay">
        <div class="jawaban-overlay">
            <div class="header">
                <div class="title">
                    <span>Detail Jawaban Pendaftar</span>
                    <span>Event: Webinar Coding</span>
                </div>
                <i data-lucide="x" class="icon"></i>
            </div>

            <div class="list-jawaban">
                <div class="jawaban-item">
                    <span class="pertanyaan">Nama Lengkap</span>
                    <span class="jawaban">Abdul Somad</span>
                </div>
                <div class="jawaban-item">
                    <span class="pertanyaan">Email</span>
                    <span class="jawaban">abdul@eventify.com</span>
                </div>
                <div class="jawaban-item">
                    <span class="pertanyaan">Nomor Telepon</span>
                    <span class="jawaban">08123456789</span>
                </div>
                <div class="jawaban-item">
                    <span class="pertanyaan">Alamat</span>
                    <span class="jawaban">Jl. Contoh No. 123</span>
                </div>
                <div class="jawaban-item">
                    <span class="pertanyaan">Motivasi</span>
                    <span class="jawaban">Saya ingin belajar coding</span>
                </div>
            </div>

            <div class="button">
                <button class="tolak">Tolak</button>
                <button class="terima">Terima</button>
            </div>

        </div>
    </div>
            
    <script src="../../assets/js/global.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const overlay = document.querySelector('.overlay');
            const close = document.querySelector('.jawaban-overlay .icon');
            const lihatJawaban = document.querySelectorAll('.lihat-jawaban');

            lihatJawaban.forEach(button => {
                button.addEventListener('click', () => {
                    overlay.classList.add('active');
                });
            });

            close.addEventListener('click', () => {
                overlay.classList.remove('active');
            });
        })
    </script>
</body>
</html>