<?php
require_once '../../config/config.php';
require_once '../../../koneksi/koneksi.php';

session_start();

$id = $_GET['id'] ?? 1;

$events = [
  1 => [
    'title' => 'Tech Future Summit 2026',
    'type' => 'Seminar',
    'price' => 'Gratis',
    'date' => '18 Mei 2026',
    'location' => 'Swiss-Belhotel Lampung',
    'image' => BASEURL . '/assets/images/image.png',
  ],

  2 => [
    'title' => 'Digital Marketing for Beginner',
    'type' => 'Seminar',
    'price' => 'Gratis',
    'date' => '12 Mei 2026',
    'location' => 'Bandar Lampung',
    'image' => BASEURL . '/assets/images/image.png',
  ],

  3 => [
    'title' => 'Coastal Cleanup Movement',
    'type' => 'Volunteer',
    'price' => 'Gratis',
    'date' => '15 Mei 2026',
    'location' => 'Pantai Mutun',
    'image' => BASEURL . '/assets/images/volunteer.jpeg',
  ],

  4 => [
    'title' => 'AI For Student Career',
    'type' => 'Webinar',
    'price' => 'Rp25.000',
    'date' => '21 Mei 2026',
    'location' => 'Zoom Meeting',
    'image' => BASEURL . '/assets/images/image.png',
  ],
];

$event = $events[$id] ?? $events[1];
$isPaid = $event['price'] !== 'Gratis';
$pageTitle = "Pendaftaran Event | Eventify";
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

<section class="register-event-page">
  <div class="container">

    <div class="section-head">
      <h2>Pendaftaran Event</h2>
      <p>Lengkapi data diri untuk mengikuti event pilihanmu.</p>
    </div>

    <div class="register-event-layout">

      <!-- LEFT -->
      <div class="register-event-form card-white">

        <div class="form-row">
          <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" placeholder="Masukkan nama lengkap">
          </div>

          <div class="form-group">
            <label>Email</label>
            <input type="email" placeholder="Masukkan email aktif">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>No. HP</label>
            <input type="text" placeholder="08xxxxxxxxxx">
          </div>

          <div class="form-group">
            <label>Instansi / Kampus</label>
            <input type="text" placeholder="Contoh: Universitas Lampung">
          </div>
        </div>

        <div class="form-group">
          <label>Motivasi Mengikuti Event</label>
          <textarea rows="6" placeholder="Tulis alasan kamu mengikuti event ini..."></textarea>
        </div>

        <?php if($isPaid): ?>
        <div class="payment-box">
          <h3>Pembayaran</h3>

          <div class="payment-info">
            <span>Bank BCA</span>
            <strong>1234567890</strong>
            <small>a.n Eventify Bandar Lampung</small>
          </div>

          <div class="form-group">
            <label>Upload Bukti Transfer</label>
            <input type="file">
          </div>
        </div>
        <?php endif; ?>

      </div>

      <!-- RIGHT -->
      <aside class="register-event-summary card-white">

        <img src="<?= $event['image']; ?>" alt="<?= $event['title']; ?>">

        <div class="summary-content">
          <span class="badge blue"><?= $event['type']; ?></span>
          <span class="badge yellow"><?= $event['price']; ?></span>

          <h3><?= $event['title']; ?></h3>

          <div class="summary-meta">
            <p><i class='bx bx-calendar'></i> <?= $event['date']; ?></p>
            <p><i class='bx bx-map'></i> <?= $event['location']; ?></p>
            <p><i class='bx bx-check-circle'></i> Menunggu Submit</p>
          </div>

          <button class="btn-primary full-btn">
            Submit Pendaftaran
          </button>
        </div>

      </aside>

    </div>

  </div>
</section>

</body>
</html>