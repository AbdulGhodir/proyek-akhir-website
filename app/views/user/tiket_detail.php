<?php
/** @var string $pageTitle */
/** @var array $tiket */
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle; ?></title>
    
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/user-style/user-style.css?v=<?= time(); ?>">
</head>
<body>

<?php include 'navbar.php'; ?>

<section class="ticket-page">
    <div class="ticket-container">
        <a href="<?= BASEURL; ?>/app/controllers/user/riwayat-pendaftaran.php" class="btn-back" style="margin-bottom: 24px;">
            <i class='bx bx-arrow-back'></i> Kembali
        </a>

        <?php if (!empty($tiket)): ?>
            <div class="ticket-card">
                <div class="ticket-info">
                    <h2><?= $tiket['acara']; ?></h2>
                    <p><strong>Nama</strong> <?= $tiket['nama']; ?></p>
                    <p><strong>Tanggal</strong> <?= $tiket['tanggal']; ?></p>
                    <p><strong>Lokasi</strong> <?= $tiket['lokasi']; ?></p>
                </div>
                
                <div class="ticket-qr-section">
                    <div class="ticket-qr-box" style="padding: 12px; display: flex; justify-content: center; align-items: center;">
                        <img 
                            src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?= urlencode($tiket['kode']); ?>" 
                            alt="QR Code Tiket" 
                            style="width: 100px; height: 100px; border-radius: 4px;"
                        >
                    </div>
                    <p class="ticket-code-text"><?= $tiket['kode']; ?></p>
                </div>
            </div>
        <?php else: ?>
            <div class="ticket-card ticket-error">
                <h3>Tiket Tidak Ditemukan</h3>
                <p>ID tiket tidak valid, belum diterima, atau tidak tersedia.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

</body>
</html>