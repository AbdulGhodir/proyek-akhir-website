<?php
    require_once 'app/config/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventify</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/global.css">
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/landing.css">
</head>
<body>
    <header>
        <div class="icon">
            <img src="<?= BASEURL; ?>/assets/images/logo.png" alt="" style="width: 1.5rem; height: 1.5rem; object-fit: cover;">
            <span>ventify</span>
        </div>

        <div class="button">
            <a href="<?= BASEURL; ?>/app/views/auth/login_register.php" class="button-login">Masuk</a>
            <a href="<?= BASEURL; ?>/app/views/auth/login_register.php?mode=daftar" class="button-register">Daftar</a>
        </div>
    </header>

    <section>
        <div class="top-content">
            <div class="left-content">
                <span class="header-title">Platform Event Bandar Lampung</span>
                
                <span class="main-title">Temukan Dan Kelola Event Dengan Mudah</span>
                
                <span class="description">Eventify adalah wadah terpusat untuk menemukan, mendaftar, dan menyelenggarakan kegiatan Volunteer, Seminar, dan Webinar di Kota Bandar Lampung. Mari berkontribusi untuk lingkungan dan masyarakat!</span>
                
                <div class="button">
                    <a href="<?= BASEURL; ?>/app/views/user/dashboard.php">
                        Mulai Jelajahi
                        <i data-lucide="arrow-right" style="width: 1rem; height: 1rem;"></i>
                    </a>
                    <a href="<?= BASEURL; ?>/app/views/admin/index.php">Lihat Event</a>
                </div>
            </div>

            <div class="right-content">
                <img src="<?= BASEURL; ?>/assets/images/volunteer.jpeg" alt="">
            </div>
        </div>

        <div class="content">
            <div class="preview-content">
                <div class="content-title">
                    <span class="title">Tentukan Pilihanmu</span>
                    <span>Temukan berbagai macam kegiatan seru dan bermanfaat yang sudah divalidasi keamanannya.</span>
                </div>
                
                <div class="card">
                    <div class="card-item">
                        <i class="icon" data-lucide="users" style="width: 4rem; height: 4rem;"></i>
                        <span class="title-card">Kegiatan Volunteer</span>
                        <span class="desc-card">Ikuti aksi nyata membersihkan pantai, mengajar anak jalanan, hingga penggalangan dana sosial. Pendaftaran sangat mudah lewat Eventify.</span>
                    </div>
                    
                    <div class="card-item">
                        <i class="icon" data-lucide="presentation" style="width: 4rem; height: 4rem;"></i>
                        <span class="title-card">Seminar Edukatif</span>
                        <span class="desc-card">Tingkatkan wawasan dan koneksi melalui berbagai seminar offline di Bandar Lampung yang diselenggarakan oleh instansi terpercaya.</span>
                    </div>
                    
                    <div class="card-item">
                        <i class="icon" data-lucide="monitor-play" style="width: 4rem; height: 4rem;"></i>
                        <span class="title-card">Webinar Online</span>
                        <span class="desc-card">Tidak sempat keluar rumah? Temukan daftar webinar informatif yang bisa kamu ikuti darimana saja untuk meningkatkan skill-mu.</span>
                    </div>
                </div>
            </div>

            <div class="preview-event">
                <div class="preview-event-header">
                    <div class="content-title">
                        <span>Event-Event Terdekat</span>
                        <span>Jangan sampai ketinggalan acara-acara seru di Bandar Lampung!</span>
                    </div>
                    <a href="">Lihat Semua <i data-lucide="arrow-right" style="width: 1rem; height: 1rem;"></i></a>
                </div>

                <div class="card">
                    <div class="event-card">
                        <img src="<?= BASEURL; ?>/assets/images/image.png" alt="">
                        <div class="event-info">
                            <div class="event-type">
                                <span class="kategori">Seminar</span>
                                <span class="harga">Gratis</span>
                            </div>
                            <span class="event-title">Seminar Startup Lampung 2026</span>
                            <div class="event-detail">
                                <div class="event-time">
                                    <i data-lucide="calendar" style="width: 1rem; height: 1rem;"></i>
                                    <span>15 Agustus 2026 pukul 09.00</span>
                                </div>
                                <div class="event-location">
                                    <i data-lucide="map-pin" style="width: 1rem; height: 1rem;"></i>
                                    <span>GSG Universitas Lampung</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="event-card">
                        <img src="<?= BASEURL; ?>/assets/images/image.png" alt="">
                        <div class="event-info">
                            <div class="event-type">
                                <span class="kategori">Seminar</span>
                                <span class="harga">Gratis</span>
                            </div>
                            <span class="event-title">Seminar Startup Lampung 2026</span>
                            <div class="event-detail">
                                <div class="event-time">
                                    <i data-lucide="calendar" style="width: 1rem; height: 1rem;"></i>
                                    <span>15 Agustus 2026 pukul 09.00</span>
                                </div>
                                <div class="event-location">
                                    <i data-lucide="map-pin" style="width: 1rem; height: 1rem;"></i>
                                    <span>GSG Universitas Lampung</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="event-card">
                        <img src="<?= BASEURL; ?>/assets/images/image.png" alt="">
                        <div class="event-info">
                            <div class="event-type">
                                <span class="kategori">Seminar</span>
                                <span class="harga">Gratis</span>
                            </div>
                            <span class="event-title">Seminar Startup Lampung 2026</span> 
                            <div class="event-detail">
                                <div class="event-time">
                                    <i data-lucide="calendar" style="width: 1rem; height: 1rem;"></i>
                                    <span>15 Agustus 2026 pukul 09.00</span>
                                </div>
                                <div class="event-location">
                                    <i data-lucide="map-pin" style="width: 1rem; height: 1rem;"></i>
                                    <span>GSG Universitas Lampung</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <span>© 2026 Eventify • Kelompok 2 - Pemrograman Website</span>
    </footer>

    <script src="<?= BASEURL; ?>/assets/js/global.js"></script>
</body>
</html>