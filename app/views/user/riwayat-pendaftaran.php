<?php
/** @var string $pageTitle */
/** @var array $history */
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

<?php include 'navbar.php'; ?>

<section class="history-page">
  <div class="container">

    <a href="<?= BASEURL; ?>/app/controllers/user/dashboard.php" class="btn-back">
        <i class='bx bx-arrow-back'></i> Kembali ke Beranda
    </a>

    <div class="section-head">
      <h2>Riwayat Pendaftaran</h2>
      <p>Lihat status event yang pernah kamu daftar.</p>
    </div>

    <div class="history-filter">
      <button class="filter-pill active" onclick="filterRiwayat('semua')">Semua</button>
      <button class="filter-pill" onclick="filterRiwayat('menunggu verifikasi')">Menunggu Verifikasi</button>
      <button class="filter-pill" onclick="filterRiwayat('diterima')">Diterima</button>
      <button class="filter-pill" onclick="filterRiwayat('ditolak')">Ditolak</button>
    </div>

    <div class="history-list">

      <?php if (empty($history)): ?>
          <div class="empty-state">
              <i class='bx bx-receipt empty-icon'></i>
              <h3>Belum Ada Riwayat Pendaftaran</h3>
              <p>Kamu belum mendaftar ke event mana pun. Yuk, mulai cari event menarik untuk upgrade skill kamu!</p>
              <a href="<?= BASEURL; ?>/app/controllers/user/dashboard.php" class="btn-primary" style="display: inline-block; text-decoration: none;">Cari Event Sekarang</a>
          </div>
      <?php else: ?>
          <?php foreach($history as $item): 
            $status_asli = $item['status_pendaftaran'];

            if ($status_asli == 'diterima') {
              $status_text = 'Diterima';
              $status_filter = 'diterima';
              $statusClass = 'status-success';
            } elseif ($status_asli == 'menunggu') {
              $status_text = 'Menunggu Verifikasi';
              $status_filter = 'menunggu verifikasi';
              $statusClass = 'status-warning';
            } else {
              $status_text = 'Ditolak';
              $status_filter = 'ditolak';
              $statusClass = 'status-danger';
            }

            $gambar = !empty($item['cover_image'])
                ? BASEURL . '/assets/images/uploads/' . $item['cover_image']
                : BASEURL . '/assets/images/image.png';
          ?>

          <div 
            class="history-card" 
            data-status="<?= $status_filter; ?>"
            data-search="<?= strtolower($item['judul'] . ' ' . $item['kategori'] . ' ' . $item['lokasi'] . ' ' . $status_text); ?>"
          >

            <img src="<?= $gambar; ?>" alt="<?= $item['judul']; ?>">

            <div class="history-content">
              <div class="history-top">
                <span class="badge blue"><?= $item['kategori']; ?></span>
                <span class="status-badge <?= $statusClass; ?>">
                  <?= $status_text; ?>
                </span>
              </div>

              <h3><?= $item['judul']; ?></h3>

              <div class="history-meta">
                <p><i class='bx bx-calendar'></i> <?= formatTanggalIndo($item['waktu_pelaksanaan']); ?></p>
                <p><i class='bx bx-map'></i> <?= $item['lokasi']; ?></p>
              </div>

              <div class="history-action">
                <?php if($status_asli == 'diterima'): ?>
                  <a href="<?= BASEURL; ?>/app/views/user/tiket_detail.php?id=<?= $item['id_pendaftaran']; ?>" class="btn-primary" style="text-decoration: none; width: max-content; padding: 0 24px; display: inline-flex; align-items: center;">Lihat Tiket</a>
                <?php elseif($status_asli == 'menunggu'): ?>
                  <button class="btn-secondary" disabled>Sedang Diverifikasi</button>
                <?php else: ?>
                  <button class="btn-danger" disabled>Pendaftaran Ditolak</button>
                <?php endif; ?>
              </div>

            </div>
          </div>

          <?php endforeach; ?>
      <?php endif; ?>

    </div>

  </div>
</section>

<script src="<?= BASEURL; ?>/assets/js/user/riwayat_pendaftaran.js"></script>

</body>
</html>