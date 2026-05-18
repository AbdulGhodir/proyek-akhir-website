<?php
    /** @var int $totalEventAktif */
    /** @var int $totalEventPending */
    /** @var int $totalPendaftar */
    /** @var array $listEvent */
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
                    <span><?= $totalEventAktif ?></span>
                    <span>Event Aktif</span>
                </div>
            </div>

            <div class="total-item">
                <i class="icon" data-lucide="clock"></i>
                <div class="total-info">
                    <span><?= $totalEventPending ?></span>
                    <span>Menunggu Validasi</span>
                </div>
            </div>

            <div class="total-item">
                <i class="icon" data-lucide="users"></i>
                <div class="total-info">
                    <span><?= $totalPendaftar ?></span>
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
                <?php if (count($listEvent) > 0) : ?>
                    <?php foreach (array_slice($listEvent, 0, 4) as $event): ?>
                        <div class="event-item">
                            <div class="img-and-info">
                                <img src="<?= BASEURL; ?>/assets/images/image.png" alt="">
                                <div class="event-info">
                                    <span><?= $event['judul'] ?></span>
                                    <span><?= $event['kategori'] . " - Rp " . $event['biaya'] ?></span>
                                </div>
                            </div>

                            <?php if ($event['status_publikasi'] == "Pending") : ?>
                                <span class="status pending"><?= $event['status_publikasi'] ?></span>
                            <?php elseif ($event['status_publikasi'] == "Dipublikasikan") : ?>
                                <span class="status published"><?= $event['status_publikasi'] ?></span>
                            <?php elseif ($event['status_publikasi'] == "Ditolak") : ?>
                                <span class="status rejected"><?= $event['status_publikasi'] ?></span>
                            <?php endif; ?>
                        </div>

                        <hr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <span class="tidak-ada">Belum ada event</span>
                <?php endif; ?>
            </div>

        </div>

    </section>

    <script src="<?= BASEURL; ?>/assets/js/global.js"></script>
    
</body>
</html>