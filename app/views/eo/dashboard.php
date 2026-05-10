<?php
    require_once '../../config/config.php';
    require_once '../../../koneksi/koneksi.php';

    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/global.css">
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/eo/dashboard.css">
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/eo/navbar.css">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>
    <?php
        $halamanAktif = 'dashboard';
        include 'navbar.php';
    ?>
    
    <section>
        <div class="header">
            <div class="welcome-text">
                <span>Event Organizer</span>
                <span>Halo, <?= $_SESSION['nama_lengkap']; ?></span>
                <span>Ringkasan event anda di sini</span>
            </div>
            
            <a href="form_event.php">
                <i class="icon" data-lucide="plus"></i>
                Buat Event Baru
            </a>
        </div>

        <div class="ringkasan-total">
            <div class="total-item">
                <i class="icon" data-lucide="calendar"></i>
                <div class="total-info">
                    <span>2</span>
                    <span>Event Aktif</span>
                </div>
            </div>

            <div class="total-item">
                <i class="icon" data-lucide="clock"></i>
                <div class="total-info">
                    <span>2</span>
                    <span>Menunggu Validasi</span>
                </div>
            </div>

            <div class="total-item">
                <i class="icon" data-lucide="users"></i>
                <div class="total-info">
                    <span>100</span>
                    <span>Pendaftar</span>
                </div>
            </div>
        </div>

        <div class="event-terbaru">
            <div class="header-content">
                <span>Event Terbaru</span>
                <a href="event.php">Lihat Semua</a>
            </div>

            <div class="list-event">
                <div class="event-item">
                    <div class="img-and-info">
                        <img src="<?= BASEURL; ?>/assets/images/image.png" alt="">
                        <div class="event-info">
                            <span>Seminar Lampung Jaya</span>
                            <span>Seminar - Rp 100.000</span>
                        </div>
                    </div>

                    <span class="status pending">Pending</span>
                </div>

                <hr>
                
                <div class="event-item">
                    <div class="img-and-info">
                        <img src="<?= BASEURL; ?>/assets/images/image.png" alt="">
                        <div class="event-info">
                            <span>Konser Musik</span>
                            <span>Konser - Gratis</span>
                        </div>
                    </div>

                    <span class="status published">Dipublikasi</span>
                </div>
                
                <hr>
                
                <div class="event-item">
                    <div class="img-and-info">
                        <img src="<?= BASEURL; ?>/assets/images/image.png" alt="">
                        <div class="event-info">
                            <span>Konser Musik</span>
                            <span>Konser - Gratis</span>
                        </div>
                    </div>
                    
                    <span class="status rejected">Ditolak</span>
                </div>
                
                <hr>
                
                <div class="event-item">
                    <div class="img-and-info">
                        <img src="<?= BASEURL; ?>/assets/images/image.png" alt="">
                        <div class="event-info">
                            <span>Konser Musik</span>
                            <span>Konser - Gratis</span>
                        </div>
                    </div>

                    <span class="status rejected">Ditolak</span>
                </div>
            </div>

        </div>

    </section>

    <script src="<?= BASEURL; ?>/assets/js/global.js"></script>
    
</body>
</html>