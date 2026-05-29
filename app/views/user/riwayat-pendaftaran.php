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

      <?php foreach($history as $item): 
        $status_asli = $item['status'];
        $status_filter = strtolower($status_asli); 
        
        $statusClass = '';
        if($status_asli == 'Diterima'){
          $statusClass = 'status-success';
        } elseif($status_asli == 'Menunggu Verifikasi'){
          $statusClass = 'status-warning';
        } else {
          $statusClass = 'status-danger';
        }
      ?>
      
      <div class="history-card" data-status="<?= $status_filter; ?>">

        <img src="<?= $item['image']; ?>" alt="<?= $item['title']; ?>">

        <div class="history-content">
          <div class="history-top">
            <span class="badge blue"><?= $item['type']; ?></span>
            <span class="status-badge <?= $statusClass; ?>">
              <?= $status_asli; ?>
            </span>
          </div>

          <h3><?= $item['title']; ?></h3>

          <div class="history-meta">
            <p><i class='bx bx-calendar'></i> <?= $item['date']; ?></p>
            <p><i class='bx bx-map'></i> <?= $item['location']; ?></p>
          </div>

          <?php if(isset($item['reason'])): ?>
            <div class="reject-note">
              <?= $item['reason']; ?>
            </div>
          <?php endif; ?>

          <div class="history-action">
            <?php if($status_asli == 'Diterima'): ?>
              <a href="<?= BASEURL; ?>/app/views/user/tiket_detail.php?id=<?= $item['id_pendaftaran'] ?? ''; ?>" class="btn-primary" style="text-decoration: none; width: max-content; padding: 0 24px; display: inline-flex; align-items: center;">Lihat Tiket</a>
            <?php elseif($status_asli == 'Menunggu Verifikasi'): ?>
              <button class="btn-secondary" disabled>Sedang Diverifikasi</button>
            <?php else: ?>
              <button class="btn-danger" disabled>Pendaftaran Ditolak</button>
            <?php endif; ?>
          </div>

        </div>
      </div>
      <?php endforeach; ?>

    </div>

  </div>
</section>

<script>
  function filterRiwayat(status) {
      const cards = document.querySelectorAll('.history-card');
      const pills = document.querySelectorAll('.filter-pill');

      pills.forEach(btn => {
          btn.classList.remove('active');
          if (btn.innerText.toLowerCase() === status || (status === 'semua' && btn.innerText === 'Semua')) {
              btn.classList.add('active');
          }
      });

      cards.forEach(card => {
          const statusCard = card.getAttribute('data-status').toLowerCase();

          if (status === 'semua') {
              card.style.display = '';
          } else {
              if (statusCard === status) {
                  card.style.display = '';
              } else {
                  card.style.display = 'none';
              }
          }
      });
  }
</script>

</body>
</html>