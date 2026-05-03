<?php
$pageTitle = "Dashboard Pengguna | Eventify";
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

<section class="hero">
  <div class="container">

    <div class="hero-card">

      <div class="hero-content">

        <div class="hero-badge">
          <i class='bx bxs-badge-check'></i>
          Platform Event Terpusat Bandar Lampung
        </div>

        <h1>
          Temukan Event Terbaik Untuk Upgrade Dirimu!
        </h1>

        <p>
          Ikuti seminar, webinar, dan volunteer yang sudah tervalidasi dan terpercaya hanya di Eventify!
        </p>

        <div class="hero-chips">
          <button>Seminar</button>
          <button>Webinar</button>
          <button>Volunteer</button>
        </div>

      </div>

    </div>

  </div>
</section>

<section class="filters">
  <div class="container">

    <div class="filter-wrap">
      <button class="filter-pill active">Semua</button>
      <button class="filter-pill">Seminar</button>
      <button class="filter-pill">Webinar</button>
      <button class="filter-pill">Volunteer</button>
      <button class="filter-pill">Gratis</button>
      <button class="filter-pill">Berbayar</button>
    </div>

  </div>
</section>

<section class="section">
  <div class="container">

    <div class="section-head">
      <div>
        <h2>Featured Event</h2>
        <p>Event pilihan minggu ini!</p>
      </div>
    </div>

    <div class="featured">

      <div class="feature-card">

        <div class="feature-badge">
          Featured Event
        </div>

        <h3 class="feature-title">
          Tech Future Summit 2026
        </h3>

        <p class="feature-desc">
          Seminar teknologi terbesar di Bandar Lampung
          yang membahas Artificial Intelligence,
          Cyber Security, dan Future Digital Industry.
        </p>

        <div class="feature-meta">
          <span>
            <i class='bx bx-calendar'></i>
            18 Mei 2026
          </span>

          <span>
            <i class='bx bx-map'></i>
            Swiss-Belhotel Lampung
          </span>
        </div>

        <a href="detail-event.php?id=1" class="feature-btn">
          Lihat Detail Event
        </a>

      </div>

      <div class="feature-mini">

        <h3>Event Highlights</h3>

        <div class="highlight-list">

          <div class="highlight-item">
            <h4>Sertifikat Resmi</h4>
            <p>Dapatkan e-certificate resmi.</p>
          </div>

          <div class="highlight-item">
            <h4>Networking</h4>
            <p>Bangun relasi profesional.</p>
          </div>

          <div class="highlight-item">
            <h4>Expert Speaker</h4>
            <p>Materi langsung dari ahlinya.</p>
          </div>

        </div>

      </div>

    </div>

    <div class="section-head">
      <div>
        <h2>Jelajahi Event</h2>
        <p>Pilih event sesuai minatmu</p>
      </div>
    </div>

    <div class="event-grid">

      <div class="event-card">
        <div class="event-thumb thumb-1"></div>

        <div class="event-body">
          <div class="badges">
            <span class="badge blue">Seminar</span>
            <span class="badge yellow">Gratis</span>
          </div>

          <h3 class="event-title">
            Digital Marketing for Beginner
          </h3>

          <div class="meta">
            <span><i class='bx bx-calendar'></i> 12 Mei 2026</span>
            <span><i class='bx bx-map'></i> Bandar Lampung</span>
            <span><i class='bx bx-buildings'></i> Radisson Lampung Kedaton</span>
          </div>

          <a href="detail-event.php?id=2" class="btn-primary">
            Lihat Detail
          </a>
        </div>
      </div>

      <div class="event-card">
        <div class="event-thumb thumb-2"></div>

        <div class="event-body">
          <div class="badges">
            <span class="badge blue">Volunteer</span>
            <span class="badge yellow">Gratis</span>
          </div>

          <h3 class="event-title">
            Coastal Cleanup Movement
          </h3>

          <div class="meta">
            <span><i class='bx bx-calendar'></i> 15 Mei 2026</span>
            <span><i class='bx bx-map'></i> Pantai Mutun</span>
            <span><i class='bx bx-buildings'></i> Green Lampung</span>
          </div>

         <a href="detail-event.php?id=3" class="btn-primary">
            Lihat Detail
          </a>
        </div>
      </div>

      <div class="event-card">
        <div class="event-thumb thumb-3"></div>

        <div class="event-body">
          <div class="badges">
            <span class="badge blue">Webinar</span>
            <span class="badge yellow">Rp25.000</span>
          </div>

          <h3 class="event-title">
            AI For Student Career
          </h3>

          <div class="meta">
            <span><i class='bx bx-calendar'></i> 21 Mei 2026</span>
            <span><i class='bx bx-map'></i> Zoom Meeting</span>
            <span><i class='bx bx-buildings'></i> TechTalk ID</span>
          </div>

          <a href="detail-event.php?id=4" class="btn-primary">
            Lihat Detail
          </a>
        </div>
      </div>

    </div>

  </div>
</section>

</body>
</html>