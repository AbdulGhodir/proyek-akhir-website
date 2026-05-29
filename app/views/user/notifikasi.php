<?php
session_start();

if (!defined('BASEURL')) {
    define('BASEURL', 'http://localhost/proyek-akhir-website'); 
}

if (!isset($pageTitle)) {
    $pageTitle = "Semua Notifikasi | Eventify";
}

$notifikasi_kosong = false; 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle; ?></title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/user-style/user-style.css">
</head>
<body>

<?php @include 'navbar.php'; ?>

<section class="section">
    <div class="container">
        
        <a href="<?= BASEURL; ?>/app/controllers/user/dashboard.php" class="btn-back">
            <i class='bx bx-arrow-back'></i> Kembali ke Beranda
        </a>

        <div class="section-head" style="margin-bottom: 24px;">
            <h2>Notifikasi Saya</h2>
            <p>Pantau semua pembaruan dan status aktivitasmu di sini.</p>
        </div>

        <div class="notif-page-container">
            
            <?php if ($notifikasi_kosong): ?>
                <div class="empty-state">
                    <i class='bx bx-bell empty-icon'></i>
                    <h3>Belum Ada Notifikasi</h3>
                    <p>Saat ini belum ada pembaruan atau aktivitas baru untukmu. Jelajahi event dan mulai mendaftar!</p>
                    <a href="<?= BASEURL; ?>/app/controllers/user/dashboard.php" class="btn-primary" style="display: inline-block; text-decoration: none;">Cari Event Sekarang</a>
                </div>

            <?php else: ?>
                <a href="<?= BASEURL; ?>/app/views/user/tiket_detail.php?id=120" class="notif-item unread" style="text-decoration: none; color: inherit; display: flex;">
                    <div class="notif-icon icon-success">
                        <i class='bx bx-check-circle'></i>
                    </div>
                    <div class="notif-content">
                        <h4>Pendaftaran Diterima!</h4>
                        <p>Hore! Pendaftaran <strong>Tech Future Summit 2026</strong> telah Diterima. Cek tiketmu sekarang!</p>
                        <span class="notif-time">10 menit yang lalu</span>
                    </div>
                    <div class="notif-dot"></div>
                </a>

                <a href="<?= BASEURL; ?>/app/controllers/user/riwayat-pendaftaran.php" class="notif-item unread" style="text-decoration: none; color: inherit; display: flex;">
                    <div class="notif-icon icon-warning">
                        <i class='bx bx-time-five'></i>
                    </div>
                    <div class="notif-content">
                        <h4>Menunggu Verifikasi</h4>
                        <p>Pendaftaran <strong>Digital Marketing for Beginner</strong> sedang Menunggu Verifikasi panitia.</p>
                        <span class="notif-time">1 jam yang lalu</span>
                    </div>
                    <div class="notif-dot"></div>
                </a>
                
                <a href="<?= BASEURL; ?>/app/views/user/profile.php" class="notif-item" style="text-decoration: none; color: inherit; display: flex;">
                    <div class="notif-icon icon-primary">
                        <i class='bx bx-user-check'></i>
                    </div>
                    <div class="notif-content">
                        <h4>Pembaruan Profil</h4>
                        <p>Perubahan <strong>Profil Saya</strong> berhasil disimpan.</p>
                        <span class="notif-time">Kemarin, 14:30 WIB</span>
                    </div>
                </a>

                <a href="<?= BASEURL; ?>/app/controllers/user/riwayat-pendaftaran.php" class="notif-item" style="text-decoration: none; color: inherit; display: flex;">
                    <div class="notif-icon icon-danger">
                        <i class='bx bx-x-circle'></i>
                    </div>
                    <div class="notif-content">
                        <h4>Pendaftaran Ditolak</h4>
                        <p>Mohon maaf, pendaftaran <strong>Workshop Web Dev</strong> ditolak karena kuota penuh.</p>
                        <span class="notif-time">26 Mei 2026</span>
                    </div>
                </a>
            <?php endif; ?>

        </div>

    </div>
</section>

</body>
</html>