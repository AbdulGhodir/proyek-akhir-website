<?php
$id = $_GET['id'] ?? 1;

$events = [
  1 => [
    'title' => 'Tech Future Summit 2026',
    'type' => 'Seminar',
    'price' => 'Gratis',
    'date' => '18 Mei 2026',
    'time' => '09:00 WIB',
    'location' => 'Swiss-Belhotel Lampung',
    'desc' => 'Seminar teknologi terbesar di Bandar Lampung yang membahas Artificial Intelligence, Cyber Security, Data Science, dan Future Digital Industry.',
    'image' => 'https://images.unsplash.com/photo-1511578314322-379afb476865?q=80&w=1400&auto=format&fit=crop',
    'organizer' => 'Tech Community Lampung',
    'logo' => 'T'
  ],

  2 => [
    'title' => 'Digital Marketing for Beginner',
    'type' => 'Seminar',
    'price' => 'Gratis',
    'date' => '12 Mei 2026',
    'time' => '13:00 WIB',
    'location' => 'Bandar Lampung',
    'desc' => 'Belajar strategi digital marketing dari dasar, mulai dari branding, social media marketing, hingga ads campaign untuk pemula.',
    'image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=1400&auto=format&fit=crop',
    'organizer' => 'Himakom Unila',
    'logo' => 'H'
  ],

  3 => [
    'title' => 'Coastal Cleanup Movement',
    'type' => 'Volunteer',
    'price' => 'Gratis',
    'date' => '15 Mei 2026',
    'time' => '07:00 WIB',
    'location' => 'Pantai Mutun',
    'desc' => 'Kegiatan volunteer peduli lingkungan untuk membersihkan area pesisir bersama komunitas pecinta alam Lampung.',
    'image' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80&w=1400&auto=format&fit=crop',
    'organizer' => 'Green Lampung',
    'logo' => 'G'
  ],

  4 => [
    'title' => 'AI For Student Career',
    'type' => 'Webinar',
    'price' => 'Rp25.000',
    'date' => '21 Mei 2026',
    'time' => '19:00 WIB',
    'location' => 'Zoom Meeting',
    'desc' => 'Kupas tuntas bagaimana Artificial Intelligence membuka peluang karir baru untuk mahasiswa di era digital.',
    'image' => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?q=80&w=1400&auto=format&fit=crop',
    'organizer' => 'TechTalkID',
    'logo' => 'T'
  ],
];

$event = $events[$id] ?? $events[1];
$pageTitle = $event['title'] . " | Eventify";
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

  <link rel="stylesheet" href="../../assets/css/user-style/user-style.css">
</head>
<body>

<?php include('../includes/navbar.php'); ?>

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

         <a href="register.php?id=<?= $id; ?>" class="btn-primary">
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