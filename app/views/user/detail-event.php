<?php
/** @var string $pageTitle */
/** @var array $event */
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

<section class="detail-page">
  <div class="container">

    <div class="detail-hero">

      <div class="detail-info">

        <div class="detail-badges">
          <span class="badge blue"><?= $event['type']; ?></span>
          <span class="badge yellow"><?= $event['price']; ?></span>
        </div>

        <h1><?= $event['title']; ?></h1>

        <p class="detail-subtitle">
          <?= $event['desc']; ?>
        </p>

        <div class="detail-meta">
          <span>
            <i class='bx bx-calendar'></i>
            <?= $event['date']; ?>
          </span>

          <span>
            <i class='bx bx-time-five'></i>
            <?= $event['time']; ?>
          </span>

          <span>
            <i class='bx bx-map'></i>
            <?= $event['location']; ?>
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
        url('<?= $event['image']; ?>');"
      ></div>

    </div>

    <div class="detail-layout">

      <div class="detail-main">

        <div class="detail-card">
          <h2>Tentang Event</h2>

          <p><?= $event['desc']; ?></p>

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
            <strong><?= $event['price']; ?></strong>
          </div>

          <div class="register-info">
            <span>Tanggal</span>
            <strong><?= $event['date']; ?></strong>
          </div>

          <div class="register-info">
            <span>Waktu</span>
            <strong><?= $event['time']; ?></strong>
          </div>

         <a href="<?= BASEURL; ?>/app/controllers/user/register-event.php" class="btn-primary">
            Daftar Sekarang
        </a>
        </div>
        
        <div class="organizer-card">
            <h3>Penyelenggara</h3>

            <div class="organizer-box">
                <div class="organizer-logo">
                    <?= $event['logo']; ?>
                </div>
                <div>
                    <h4><?= $event['organizer']; ?></h4>
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