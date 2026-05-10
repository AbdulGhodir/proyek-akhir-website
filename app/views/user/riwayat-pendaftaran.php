<?php
require_once '../../config/config.php';
require_once '../../../koneksi/koneksi.php';

session_start();

$pageTitle = "Riwayat Pendaftaran | Eventify";

$history = [
  [
    'title' => 'Tech Future Summit 2026',
    'type' => 'Seminar',
    'date' => '18 Mei 2026',
    'location' => 'Swiss-Belhotel Lampung',
    'status' => 'Diterima',
    'image' => BASEURL . '/assets/images/image.png'
  ],

  [
    'title' => 'Digital Marketing for Beginner',
    'type' => 'Seminar',
    'date' => '12 Mei 2026',
    'location' => 'Bandar Lampung',
    'status' => 'Menunggu Verifikasi',
    'image' => BASEURL . '/assets/images/image.png'
  ],

  [
    'title' => 'Coastal Cleanup Movement',
    'type' => 'Volunteer',
    'date' => '15 Mei 2026',
    'location' => 'Pantai Mutun',
    'status' => 'Ditolak',
    'reason' => 'Kuota peserta telah penuh',
    'image' => BASEURL . '/assets/images/volunteer.jpeg'
  ],

  [
    'title' => 'AI For Student Career',
    'type' => 'Webinar',
    'date' => '21 Mei 2026',
    'location' => 'Zoom Meeting',
    'status' => 'Diterima',
    'image' => BASEURL . '/assets/images/image.png'
  ],
];
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