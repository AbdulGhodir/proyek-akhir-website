<?php
/** @var string $pageTitle */
/** @var array $event */
/** @var string $terdaftar */
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

<?php include 'navbar.php'; ?>

<section class="detail-page">
  <div class="container">

    <a href="<?= BASEURL; ?>/app/controllers/user/dashboard.php" class="btn-back">
        <i class='bx bx-arrow-back'></i> Kembali ke Beranda
    </a>

    <div class="detail-hero">

      <div class="detail-info">

        <div class="detail-badges">
          <span class="badge blue"><?= $event['kategori']; ?></span>
          <span class="badge yellow"><?= formatRupiah($event['biaya']); ?></span>
        </div>

        <h1><?= $event['judul']; ?></h1>

        <p class="detail-subtitle">
          <?= $event['deskripsi']; ?>
        </p>

        <div class="detail-meta">
          <span>
            <i class='bx bx-calendar'></i>
            <?= formatTanggalIndo($event['waktu_pelaksanaan']); ?>
          </span>

          <span>
            <i class='bx bx-time-five'></i>
            <?= date('H:i', strtotime($event['waktu_pelaksanaan'])) . ' WIB'; ?>
          </span>

          <span>
            <i class='bx bx-map'></i>
            <?= $event['lokasi']; ?>
          </span>

          <span>
            <i class='bx bx-check-shield'></i>
            Organizer Terverifikasi
          </span>
        </div>

      </div>

      <div
        class="detail-banner"
        style="background-image:
        linear-gradient(rgba(0,0,0,.18), rgba(0,0,0,.18)),
        url('<?= BASEURL . '/assets/images/uploads/' . $event['cover_image']; ?>');"
      ></div>

    </div>

    <div class="detail-layout">

      <div class="detail-main">

        <div class="detail-card">
          <h2>Tentang Event</h2>

          <p><?= $event['deskripsi']; ?></p>

        </div>

        <div class="detail-card">
          <h2>Benefit Mengikuti</h2>

          <ul class="benefit-list">
            <li><i class='bx bx-check-circle'></i> E-Certificate resmi</li>
            <li><i class='bx bx-check-circle'></i> Networking profesional</li>
            <li><i class='bx bx-check-circle'></i> Materi berkualitas</li>
            <li><i class='bx bx-check-circle'></i> Pengalaman baru</li>
          </ul>
        </div>

      </div>

      <aside class="detail-sidebar">

        <div class="register-card">
          <h3>Informasi Pendaftaran</h3>

          <div class="register-info">
            <span>Biaya</span>
            <strong><?= formatRupiah($event['biaya']); ?></strong>
          </div>

          <div class="register-info">
            <span>Tanggal</span>
            <strong><?= formatTanggalIndo($event['waktu_pelaksanaan']); ?></strong>
          </div>

          <div class="register-info">
            <span>Waktu</span>
            <strong><?= date('H:i', strtotime($event['waktu_pelaksanaan'])) . ' WIB'; ?></strong>
          </div>
          
          <?php if ($terdaftar == 'belum terdaftar'): ?>
            <a href="<?= BASEURL; ?>/app/controllers/user/register-event.php?id=<?= $event['id_event']; ?>" class="btn-primary">
              Daftar Sekarang
            </a>
          <?php elseif ($terdaftar == 'menunggu'): ?>
            <span style="display: block; color: #ff9800; font-weight: bold; text-align: center;">
              Sudah Terdaftar (Menunggu Verifikasi)
            </span>
          <?php elseif ($terdaftar == 'diterima'): ?>
            <span style="display: block; color: #28c76f; font-weight: bold; text-align: center;">
              Sudah Terdaftar (Diterima)
            </span>
          <?php elseif ($terdaftar == 'ditolak'): ?>
            <span style="display: block; color: #ff0000; font-weight: bold; text-align: center;">
              Sudah Terdaftar (Ditolak)
            </span>
          <?php endif; ?>
        </div>
        
        <div class="organizer-card">
            <h3>Penyelenggara</h3>

            <div class="organizer-box">
                <div class="organizer-logo">
                    <?= strtoupper(substr($event['nama_lengkap'], 0, 1)); ?>
                </div>
                <div>
                    <h4><?= $event['nama_lengkap']; ?></h4>
                    <p>Terverifikasi</p>
                </div>
            </div>
        </div>

      </aside>

    </div>

  </div>
</section>

</body>
</html>