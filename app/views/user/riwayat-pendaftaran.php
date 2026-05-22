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

  <link
    href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
    rel="stylesheet"
  >

  <link rel="stylesheet" href="<?= BASEURL; ?>/assets/css/user-style/user-style.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<section class="history-page">
  <div class="container">

    <div class="section-head">
      <h2>Riwayat Pendaftaran</h2>
      <p>Lihat status event yang pernah kamu daftar.</p>
    </div>

    <div class="history-filter">
      <button class="filter-pill active">Semua</button>
      <button class="filter-pill">Menunggu Verifikasi</button>
      <button class="filter-pill">Diterima</button>
      <button class="filter-pill">Ditolak</button>
    </div>

    <div class="history-list">

      <?php foreach($history as $item): ?>
      <div class="history-card">

        <img src="<?= $item['image']; ?>" alt="<?= $item['title']; ?>">

        <div class="history-content">

          <div class="history-top">
            <span class="badge blue"><?= $item['type']; ?></span>

            <?php
              $statusClass = '';

              if($item['status'] == 'Diterima'){
                $statusClass = 'status-success';
              } elseif($item['status'] == 'Menunggu Verifikasi'){
                $statusClass = 'status-warning';
              } else {
                $statusClass = 'status-danger';
              }
            ?>

            <span class="status-badge <?= $statusClass; ?>">
              <?= $item['status']; ?>
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

            <?php if($item['status'] == 'Diterima'): ?>
              <button class="btn-primary">Lihat Tiket</button>

            <?php elseif($item['status'] == 'Menunggu Verifikasi'): ?>
              <button class="btn-secondary">Sedang Diverifikasi</button>

            <?php else: ?>
              <button class="btn-danger">Pendaftaran Ditolak</button>
            <?php endif; ?>

          </div>

        </div>

      </div>
      <?php endforeach; ?>

    </div>

  </div>
</section>

</body>
</html>