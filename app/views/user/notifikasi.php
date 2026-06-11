<?php
/** @var string $pageTitle */
/** @var array $notifikasi */
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle; ?></title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/global.css">
</head>
<body class="user-page">

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
                
        <?php if (empty($notifikasi)): ?>
            <div class="empty-state">
                <i class='bx bx-bell empty-icon'></i>
                <h3>Belum Ada Notifikasi</h3>
                <p>Saat ini belum ada pembaruan atau aktivitas baru untukmu. Jelajahi event dan mulai mendaftar!</p>
                <a href="<?= BASEURL; ?>/app/controllers/user/dashboard.php" class="btn-primary empty-action-btn">
                    Cari Event Sekarang
                </a>
            </div>

        <?php else: ?>

            <?php foreach ($notifikasi as $notif): ?>
                <?php
                    $status = $notif['status_pendaftaran'];

                    if ($status == 'diterima') {
                        $icon = "bx-check-circle";
                        $iconClass = "icon-success";
                        $judulNotif = "Pendaftaran Diterima!";
                        $pesan = "Hore! Pendaftaran <strong>" . $notif['judul'] . "</strong> telah diterima. Cek tiketmu sekarang!";
                        $link = BASEURL . "/app/controllers/user/tiket-detail.php?id=" . $notif['id_pendaftaran'];
                    } elseif ($status == 'ditolak') {
                        $icon = "bx-x-circle";
                        $iconClass = "icon-danger";
                        $judulNotif = "Pendaftaran Ditolak";
                        $pesan = "Mohon maaf, pendaftaran <strong>" . $notif['judul'] . "</strong> telah ditolak.";
                        $link = BASEURL . "/app/controllers/user/riwayat-pendaftaran.php";
                    } else {
                        $icon = "bx-time-five";
                        $iconClass = "icon-warning";
                        $judulNotif = "Menunggu Verifikasi";
                        $pesan = "Pendaftaran <strong>" . $notif['judul'] . "</strong> sedang menunggu verifikasi panitia.";
                        $link = BASEURL . "/app/controllers/user/riwayat-pendaftaran.php";
                    }
                ?>

                <a href="<?= $link; ?>" class="notif-item unread" style="text-decoration: none; color: inherit; display: flex;">
                    <div class="notif-icon <?= $iconClass; ?>">
                        <i class='bx <?= $icon; ?>'></i>
                    </div>
                    <div class="notif-content">
                        <h4><?= $judulNotif; ?></h4>
                        <p><?= $pesan; ?></p>
                        <span class="notif-time"><?= formatWaktuRelatif($notif['tanggal_daftar']); ?></span>
                    </div>
                    <div class="notif-dot"></div>
                </a>

            <?php endforeach; ?>

        <?php endif; ?>

    </div>

    </div>
</section>

</body>
</html>